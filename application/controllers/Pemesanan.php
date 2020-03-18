<?php
/**
 * 
 */
class Pemesanan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
        $this->load->model("Model_pemesanan", "Pemesanan");
        $this->load->model("Model_pembayaran", "Pembayaran");
        $this->load->model("Model_produk", "Produk");
        $this->load->model("Model_penjual", "Usaha");
        $this->load->model("Model_pembeli", "Pembeli");
        $this->StatusPemesananBaru = "Baru";
        $this->load->library('encryption');
        $this->encryption->initialize(array('driver' => 'mcrypt'));
        date_default_timezone_set("Asia/Bangkok");
	}

	public function pesanan_user()
	{
		$id_akun = $this->input->post('id_akun');
		$data_pembeli = $this->Pembeli->detail_pembeli($id_akun);
		header("Content-type: application/json");
		echo json_encode($data_pembeli->row());
	}

	public function updatePemesanan()
	{
		$id_akun = $this->input->post('id_akun');
		$alamatLengkap = $this->input->post('alamatLengkap');
		$kotaKabupaten = $this->input->post('kotaKabupaten');
		$kecamatan = $this->input->post('kecamatan');
		$kelurahan = $this->input->post('kelurahan');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$array_update = array('alamat_pb' => $alamatLengkap,
							'kab_pb'=>$kotaKabupaten,
							'kec_pb'=>$kecamatan,
							'kel_pb'=>$kelurahan,
							'longitude_pb'=>$longitude,
							'latitude_pb'=>$latitude);
		try {
			$updateAlamat = $this->Pembeli->updateAlamat($array_update, $id_akun);
			$result = null;
			$result['responseMessage'] = "success";
		} catch (Exception $e) {
			$result['responseMessage'] = "failed with " . $e->getMessage();
		}
		header("Content-type: application/json");
		echo json_encode($result);
	}

	public function simpanPemesanan()
	{
        $result = array();
        $id_akun = $this->input->post('id_akun');
        $id_usaha = $this->input->post('id_usaha');
		$produk = $this->input->post('keranjang');
        $totalBiayaPengiriman = $this->input->post('totalBiayaPengiriman');
        $totalBiayaProduk = $this->input->post('totalBiayaProduk');
        $totalPembayaran = $totalBiayaPengiriman + $totalBiayaProduk;

		$tipePengiriman = $this->input->post('jpengiriman');
        $metodePembayaran = $this->input->post('jpembayaran');
        $tglPengiriman = $this->input->post('tglPengiriman');
        // $totalHargaProduk = 
        $tglPemesanan = date("Y/m/d H:i:s", strtotime("now"));
        $expiredDate = date("Y/m/d H:i:s", strtotime("+60 minutes"));        
        
        try{
            //TODO:INSERT DATA PEMESANAN, DETAIL PEMESANAN, PEMBAYARAN
            // Pemesanan
            $dataPemesanan = array('waktu_pemesanan' => $tglPemesanan,
            'tipe_pengiriman' => $tipePengiriman,
            'tgl_pengiriman' => $tglPengiriman,
            'biaya_kirim' => $totalBiayaPengiriman,
            'total_harga' => $totalPembayaran,
            'status_pemesanan' => $this->StatusPemesananBaru,
            'id_pb' => $id_akun,
            'id_usaha' => $id_usaha);
            $isPemesanan = $this->Pemesanan->createPemesanan($dataPemesanan);
            if($isPemesanan){
                //detailPemesanan
                $dataPemesanan = $this->Pemesanan->getDataPemesananByIdUser($id_akun, 1, 'id_pemesanan', 'DESC');
                $id_pemesanan = $dataPemesanan->row()->id_pemesanan;
                $data = array();
                $totalProduk = count($produk);
                for($i=0; $i<$totalProduk; $i++){
                    $arrayProduk = $produk[$i];
                    $idVariasi = $arrayProduk['variasi'];
                    $data[] = array('harga' => $arrayProduk['harga_produk'],
                    'jml_produk' => $arrayProduk['qty'],
                    'sub_total' => $arrayProduk['total_harga'],
                    'id_pemesanan' => $id_pemesanan,
                    'id_produk' => $idVariasi);
                }
                $isDetailPemesanan = $this->Pemesanan->createDetailPemesanan_batch($data);
                if($isDetailPemesanan){
                    //PEMBAYARAN
                    $dataPembayaran = array('metode_pembayaran' => $metodePembayaran,
                                            'expiredDate' => $expiredDate,
                                            'id_pemesanan' => $id_pemesanan);
                    $isPembayaran = $this->Pembayaran->createPembayaran($dataPembayaran);
                    if($isPembayaran){
                        $result = array('responseMessage' => 'success', 'listPemesanan' => $produk, 'responseCode' => '00', 'id_pemesanan' => $id_pemesanan);
                    }else{
                        $error = $this->db->error();
                        $result = array('responseMessage' => 'failed ' . $error['message'], 'listPemesanan' => null, 'responseCode' => '03');
                    }
                }else{
                    $error = $this->db->error();
                    $result = array('responseMessage' => 'failed ' . $error['message'], 'listPemesanan' => null, 'responseCode' => '02');
                }
            }else{
                $error = $this->db->error();
                $result = array('responseMessage' => 'failed ' . $error['message'], 'listPemesanan' => null, 'responseCode' => '01');
            }
            
        }catch(Exception $e){
                $errorMessage =  $e->getMessage();
                $result = array('responseMessage' => 'failed ' . $errorMessage, 'listPemesanan' => null, 'responseCode' => '01');
        }
        header("Content-type: application/json");
		echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function getHargaPesananById()
    {
        $idPesanan = $_POST['idPesanan'];
        $data = $this->Pemesanan->getHargaPemesananByIdPemesanan($idPesanan);
        $result = $data->row_array();
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function StatusPemesanan()
    {
        $id_pemesanan = $_POST['id_pemesanan'];
        try{
            $data = $this->Pemesanan->getStatus($id_pemesanan);
            if($data->num_rows() > 0){
                $dataResult = $data->row();
                $id1 = str_replace("-","",$dataResult->waktu_pemesanan);
                $id2 = str_replace(" ", "", $id1);
                $id3 = str_replace(":", "", $id2);
                $id4 = $id3 . $dataResult->id_pemesanan;
                $dateNew = date_create($dataResult->waktu_pemesanan);
                $dateNew2 = date_create($dataResult->tgl_pengiriman);
                $waktuPemesanan = date_format($dateNew, 'd/m/Y H:i');
                $tipePengiriman = $dataResult->tipe_pengiriman;
                $dataPesanan = $this->Pemesanan->getDetailPemesanan($id_pemesanan)->result();
                $result = array('responseMessage' => 'success', 'responseCode' => '00', 'status' => $dataResult->status_pemesanan, 'noPemesanan' => $id4, 'waktuPemesanan' => $waktuPemesanan, 'tipePengiriman' => $tipePengiriman, 'idPesanan' => $id_pemesanan, 'dataPesanan' => $dataPesanan);
            }else{
                $result = array('responseMessage' => 'failed', 'responseCode' => '02', 'status' => null);
            }
        }catch(Exception $e){
            $result = array('responseMessage' => 'failed', 'responseCode' => '01', 'status' => null);
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function getAllPemesananByAkun()
    {
        $idAkun = $_POST['id_akun'];
        $status = $_POST['status'];
        $limit = null;
        $orderBy = "id_pemesanan";
        $typeOrder = "DESC";
        $resultArray = array();
        $result = array();
        try{
            $query = $this->Pemesanan->getDataPemesananByIdUserAndStatus($idAkun, $status,$limit, $orderBy, $typeOrder);
            if($query->num_rows() > 0){
                foreach($query->result() as $dataPemesanan){
                    $id1 = str_replace("-","",$dataPemesanan->waktu_pemesanan);
                    $id2 = str_replace(" ", "", $id1);
                    $id3 = str_replace(":", "", $id2);
                    $id4 = $id3 . $dataPemesanan->id_pemesanan;
                    $dateNew = date_create($dataPemesanan->waktu_pemesanan);
                    $dateNew2 = date_create($dataPemesanan->tgl_pengiriman);
                    $waktuPemesanan = date_format($dateNew, 'd/m/Y H:i');
                    $tglPengiriman = date_format($dateNew2, 'd/m/Y');
                    $idPemesanan = $dataPemesanan->id_pemesanan;
                    $JenisPengiriman = $dataPemesanan->tipe_pengiriman;
                    $TotalHargaAll = $dataPemesanan->total_harga;
                    $BiayaPengiriman = $dataPemesanan->biaya_kirim;

                    $IdUsaha = $dataPemesanan->id_usaha;
                    $IdPembeli = $dataPemesanan->id_pb;
                    $DataUsaha = $this->Usaha->ambil_usaha_by_id($IdUsaha)->row();
                    $DataPembeli = $this->Pembeli->detail_pembeli($IdPembeli)->row();
                    $DataPembayaran = $this->Pemesanan->getDataPembayaranByIdPemesanan($idPemesanan)->row();
                    $queryDetailPesanan = $this->Pemesanan->getDetailPemesanan($idPemesanan);
                    // echo $this->db->last_query();
                    $DataDetailPesanan = $queryDetailPesanan->row();
                    if(isset($DataDetailPesanan)){
                        // var_dump($DataDetailPesanan);
                        $namaProduk = $DataDetailPesanan->nama_produk;
                        $namaProduk = $namaProduk . ' ' . $DataDetailPesanan->nama_variasi;
                        $hargaProduk = $DataDetailPesanan->harga;
                        $totalProduk = $DataDetailPesanan->jml_produk;
                        $fotoProduk = $DataDetailPesanan->foto_produk;
                        $arrayToDisplay = array('namaProduk' => $namaProduk,
                                                'hargaProduk' => $hargaProduk,
                                                'totalProduk' => $totalProduk,
                                                'fotoProduk' => $fotoProduk);
                        $DaftarProduk = $queryDetailPesanan->result_array();
                        $TotalHargaProduk = 0;
                        $TotalBeratProduk = 0;
                        $TotalProduk = 0;
                        $SubTotal = null;
                        $SubBerat = null;
                        $SubTotalProduk = null;
                        foreach($queryDetailPesanan->result() as $Products){
                            $SubTotal[] = $Products->sub_total;
                            $SubBerat[] = $Products->berat_produk;
                            $SubTotalProduk[] = $Products->jml_produk;
                        }
                        $TotalHargaProduk = array_sum($SubTotal);
                        $TotalBeratProduk = array_sum($SubBerat);
                        $TotalProduk = array_sum($SubTotalProduk);
                        $result[] = array('ID' => $id4,
                                        'idPemesanan' => $idPemesanan,
                                        'TotalHargaAll' => $TotalHargaAll,
                                        'BiayaPengiriman' => $BiayaPengiriman,
                                        'JenisPengiriman' => $JenisPengiriman,
                                        'display' => $arrayToDisplay,
                                        'AllPurchaseProduk' => $DaftarProduk,
                                        'waktuPemesanan' => $waktuPemesanan,
                                        'tglPengiriman' => $tglPengiriman,
                                        'TotalHargaProduk' => $TotalHargaProduk,
                                        'TotalBeratProduk' => $TotalBeratProduk,
                                        'TotalProduk' => $TotalProduk,
                                        'DataUsaha' => $DataUsaha,
                                        'DataPembeli' => $DataPembeli,
                                        'DataPembayaran' => $DataPembayaran);
                    }
                }
                $resultArray = array('dataPesanan' => $result,
                                    'responseMessage' => 'success',
                                    'responseCode' => "00");
            }else{
                $resultArray = array('dataPesanan' => array(),
                                    'responseMessage' => 'success',
                                    'responseCode' => "00");
            }
        }catch(Exception $e){
            $resultArray = array('dataPesanan' => null,
            'responseMessage' => 'failed ' + $e->getMessage(),
            'responseCode' => "01");
        }
        
        echo json_encode($resultArray, JSON_PRETTY_PRINT);
    }

    public function ProsesUnggahBuktiPembayaran_Pemesanan()
    {
        $bankTerpilih = $_POST['bankTerpilih'];
        $noRek = $_POST['noRek'];
        $namaRekening = $_POST['namaRekening'];
        $struk_pembayaranFile = $_POST['struk_pembayaranFile'];
        $idPemesanan = $_POST['idPemesanan'];
        $dataPembayaran = $this->Pemesanan->getDataPembayaranOnlyByIdPemesanan($idPemesanan);
        $result = array();
        if($dataPembayaran->num_rows() > 0){
            if(is_array($_FILES)){
                if(is_uploaded_file($_FILES['struk_pembayaran']['tmp_name'])){
                    $sourcePath = $_FILES['struk_pembayaran']['tmp_name'];
                    $fotoBukti = date('dmYHis') . $_FILES['struk_pembayaran']['name'];
                    $targetPath = './FotoBuktiTransaksi/'.$fotoBukti;
                    move_uploaded_file($sourcePath, $targetPath);
                }
            }
            $waktuPembayaran = date('Y-m-d H:i:s');

            $dataUpdatePembayaran = array('waktu_pembayaran' => $waktuPembayaran,
                                        'id_bank' => $bankTerpilih,
                                        'no_rekening_pb' => $noRek,
                                        'struk_pembayaran' => $fotoBukti,
                                        'status_pembayaran' => "Lunas",
                                        'nama_rekening_pb' => $namaRekening);
            $UpdatePembayaran = $this->Pemesanan->UpdatePembayaran($dataUpdatePembayaran, $idPemesanan);
            if($UpdatePembayaran){
                $dataUpdatePemesanan = array('status_pemesanan' => 'Terbayar');
                $UpdatePemesanan = $this->Pemesanan->updatePemesanan($dataUpdatePemesanan, 'id_pemesanan = '.$idPemesanan);
                $updtPmsnsn = $this->db->last_query();
                if($UpdatePemesanan){
                    $dataPembayaran = $this->Pemesanan->getDetailDataPembayaranByIdPemesanan($idPemesanan,);
                    $result = array('status' => 'berhasil', 'code' => '00', 'db' => $updtPmsnsn);
                }else{
                    $result = array('status' => 'gagal', 'code' => '02');
                }
                
            }else{
                $result = array('status' => 'gagal', 'code' => '01');
            }
        }else{
            $result = array('status' => 'gagal', 'code' => '99');
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function HapusPemesananByIdPemesanan()
    {
        $idPemesanan = $_POST['idPesanan'];
        $result = array();
        $DeletePembayaran = $this->Pemesanan->DeletePembayaran("id_pemesanan =" . $idPemesanan);
        if($DeletePembayaran){
            $DeleteDetailPemesanan = $this->Pemesanan->DeleteDetailPemesanan("id_pemesanan = " . $idPemesanan);
            if($DeleteDetailPemesanan){
                $DeletePemesanan = $this->Pemesanan->DeletePemesanan("id_pemesanan =", $idPemesanan);
                if($DeletePemesanan){
                    $result = array('responseMessage' => "success", "responseCode" => "00");
                }else{
                    $result = array('responseMessage' => "failed", "responseCode" => "01");
                }
            }else{
                $result = array('responseMessage' => "failed", "responseCode" => "02");
            }
        }else{
            $result = array('responseMessage' => "failed", "responseCode" => "03");
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
        
    }

    public function getDetailPemesanan_HTML()
    {
        $idPemesanan = $this->input->post('idPemesanan');
        $statusPemesanan = $this->input->post('statusPemesanan');
        $JenisPengiriman = $this->input->post('JenisPengiriman');
        $JenisPembayaran = $this->input->post('JenisPembayaran');
        $DataDetailPesanan = $this->Pemesanan->getDetailPemesanan($idPemesanan);
        $DataPemesanan = $this->Pemesanan->getDataPemesananByID($idPemesanan);
        $DataPembayaran = $this->Pemesanan->getDetailDataPembayaranByIdPemesanan($idPemesanan);
        $id1 = str_replace("-","",$DataPemesanan->row()->waktu_pemesanan);
        $id2 = str_replace(" ", "", $id1);
        $id3 = str_replace(":", "", $id2);
        $id4 = $id3 . $DataPemesanan->row()->id_pemesanan;
        $dateNew = date_create($DataPemesanan->row()->waktu_pemesanan);
        $dateNew2 = date_create($DataPemesanan->row()->tgl_pengiriman);
        $waktuPemesanan = date_format($dateNew, 'd/m/Y H:i');
        $tglPengiriman = date_format($dateNew2, 'd/m/Y');
        $DataPengiriman = $this->Pemesanan->getDetailPengirimanWithKurirKendaraan($idPemesanan)->row();
        
        // echo $this->db->last_query();
        $dataView = array('DataDetailPesanan' => $DataDetailPesanan, 
                        'DataPemesanan' => $DataPemesanan, 
                        'DataPembayaran' => $DataPembayaran, 
                        'waktuPemesanan' => $waktuPemesanan, 
                        'tglPengiriman' => $tglPengiriman, 
                        'noPesanan' => $id4,
                        'DataPengiriman' => $DataPengiriman);
        $LokasiHalaman = '';
        if($statusPemesanan=="Baru"){
            $LokasiHalaman = "detail-pesanan-baru-all";
          }else if($statusPemesanan=="Terbayar"){
            $LokasiHalaman = "detail-pesanan-terbayar-all";
          }else if($statusPemesanan == "Terkirim"){
              $LokasiHalaman = "detail-pesanan-terkirim-all";
          }
          $dataView['statusPemesanan'] = $statusPemesanan;
          $dataView['JenisPengiriman'] = $JenisPengiriman;
          $dataView['JenisPembayaran'] = $JenisPembayaran;
        //   var_dump($dataView);
          $this->load->view('pembeli/pesanan-saya/'.$LokasiHalaman, $dataView);
    }

}