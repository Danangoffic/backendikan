<?php
/**
 * 
 */
class Penjual extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		$this->load->model('Model_penjual', 'penjual', TRUE);
		$this->load->model('Model_rekening', 'rekening');
		$this->load->model('Model_kendaraan', 'kendaraan');
	}

	public function index()
	{
		echo "Ini adalah class penjual/index";
	}

	public function proses_update()
	{
		$username = $this->input->post('username');
		$ambil_data = $this->penjual->ambil_data_penjual($username);
		print_r($ambil_data->result_array());
	}

	public function ambil_semua()
	{
		$ambil_data = $this->penjual->ambil_semua();
		if($ambil_data->num_rows() > 0){
			$data_json = $ambil_data->result_array();
			header("Content-type: application/json");
			echo json_encode($data_json);
		}else{
			
		}
	}

	public function ambil_data_profile()
	{
		$id_pj = $this->input->post('id_akun');
		$data = $this->penjual->data_profile($id_pj);
		$data_profile = $data->row();
		
		header("Content-type: application/json");
		echo json_encode($data_profile, JSON_PRETTY_PRINT);
	}

	public function detail_usaha()
	{
		$id_usaha = $this->input->post('id_usaha');
		$data = $this->penjual->ambil_usaha_by_id($id_usaha);
		$data_usaha = $data->row();
		// header("Content-type: application/json");
		echo json_encode($data_usaha);
	}

	public function ambil_data_kel_tani()
	{
		$id_pj = $this->input->post('id_akun');
		$data = $this->penjual->data_kel_tani_penjual($id_pj);
		$hasil = $data->result_array();
		header("Content-type: application/json");
		echo json_encode($hasil);
	}

	public function ambil_data_tani()
	{
		$id_pj = $this->input->post('id_akun');
		$data_semua_tani = $this->penjual->data_kelompok_tani();
		$data_kel_tani_pj = $this->penjual->data_kel_tani_penjual($id_pj);
		$hasil = array();
		foreach ($data_semua_tani->result() as $key) {
			$cek = $this->penjual->bandingkan_kel_tani_pj($id_pj, $key->id_kelompoktani);
			if($cek->num_rows() > 0){
				$check = "checked='checked'";
			}else{
				$check = "";
			}
			$array = array(
				'id' => $key->id_kelompoktani,
				'label' => $key->nama_kelompoktani,
				'check' => $check);
			array_push($hasil, $array);
		}
		echo json_encode($hasil);
	}

	public function ambil_data_usaha()
	{
		$id_akun = $this->input->post('id_akun');
		$data = $this->penjual->ambil_data_usaha($id_akun)->row();
		header("Content-type: application/json");
		echo json_encode($data);
	}

	public function ambil_data_usaha_with_pj()
	{
		$id_akun = $this->input->post('id_akun');
		$data = $this->penjual->ambil_data_usaha_with_pj($id_akun)->row();
		header("Content-type: application/json");
		echo json_encode($data);
	}

	public function simpan_kel_tani()
	{
		$id_akun = $this->input->post('id_akun');
		$kel_tani = $this->input->post('kel_tani');
		if($kel_tani!==""):
			$kel_tani = explode(',', $kel_tani);
			$total = count($kel_tani);

			$id_usaha = $this->penjual->ambil_data_usaha($id_akun)->row()->id_usaha;

			$delete = $this->penjual->delete_kel_tani($id_usaha);
			if($total>0){
				if($total> 1){
					for ($i=0; $i < $total; $i++) { 
						$data[] = array('id_kelompoktani' => $kel_tani[$i],
							'id_usaha' => $id_usaha);
					}
					$insert = $this->penjual->insert_tani_multi($data);
				}else{
					$data = array('id_kelompoktani' => $kel_tani[0],
						'id_usaha' => $id_usaha);
					$insert = $this->penjual->insert_tani($data);
				}
				if($insert){
					$status = "berhasil";
				}else{
					$status = "gagal";
				}
			}else{
				$status = "kosong";
			}
		else:
			$status = "kosong";
		endif;
		$respons = array('status'=>$status);
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	// PROSES JAM PENGIRIMAN USAHA
	public function ambil_jam_pengiriman_usaha()
	{
		$id_usaha = $this->input->post('id_usaha');
		$data = $this->penjual->ambil_jam_pengiriman_usaha($id_usaha)->result_array();
		header("Content-type: application/json");
		echo json_encode($data);
	}

	public function simpan_jam_pengiriman_usaha()
	{
		$id_usaha = $this->input->post('id_usaha');
		$jam = $this->input->post('jam');
		$data = array(
			'id_usaha' => $id_usaha,
			'jam_pengiriman' => $jam);
		$proses = $this->penjual->simpan_jam_pengiriman_usaha($data);
		if($proses){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}

		$respons = array('status' => $status);
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	public function ambil_jam_pengiriman_usaha_by_id()
	{
		$id_jampengiriman = $this->input->post('id_jampengiriman');
		$data = $this->penjual->ambil_jam_pengiriman_usaha_by_id($id_jampengiriman)->row_array();
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	public function ubah_jam_pengiriman_usaha()
	{
		$id_jampengiriman = $this->input->post('id_jampengiriman');
		$jam = $this->input->post('jam');
		$data = array(
			'jam_pengiriman'=>$jam);
		$proses = $this->penjual->ubah_jam_pengiriman_usaha($data, $id_jampengiriman);
		if($proses){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}

		$respons = array('status' => $status);
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	public function hapus_jam_pengiriman_usaha()
	{
		$id_jampengiriman = $this->input->post('id_jampengiriman');
		$proses = $this->penjual->hapus_jam_pengiriman_usaha($id_jampengiriman);
		if($proses){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}

		$respons = array('status' => $status);
		header("Content-type: application/json");
		echo json_encode($respons);
	}
	// END PROSES JAM PENGIRIMAN USAHA

	
	// PROSES BAGIAN REKENING
	public function ambil_rekening()
	{
		$id_akun = $this->input->post('id_akun');
		$data = $this->rekening->ambil_rekening_by_user($id_akun);
		$respons = $data->result_array();
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	public function pembayaran_ambil_rekening_html()
	{
		$id_akun = $this->input->post('id_akun');
		$data = $this->rekening->ambil_rekening_by_user($id_akun);
		// $respons = $data->result_array();
		header("Content-type: text/html");
		$this->load->view("pembeli/pesanan-saya/pembayaran", array('dataRekening' => $data));
		// echo json_encode($respons);
	}

	public function simpan_rekening()
	{
		$bank = $this->input->post('bank');
		$norek = $this->input->post('norek');
		$namarek = $this->input->post('namarek');
		$id_akun = $this->input->post('id_akun');
		$data_ins = array('kode_bank' => $bank, 'id_akun' => $id_akun, 'no_rekening' => $norek, 'nama_rekening' => $namarek);
		$insert = $this->rekening->simpan_rekening($data_ins);
		if($insert){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}

		$respons = array('status' => $status);
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	public function ambil_rekening_by_id()
	{
		// $id_akun = $this->input->post('id_akun');
		$id_rekening = $this->input->post('id_rekening');
		$data = $this->rekening->ambil_rekening_by_id($id_rekening)->row_array();
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	public function ubah_rekening()
	{
		$id_rekening = $this->input->post('id_rekening');
		$kode_bank = $this->input->post('bank');
		$id_akun = $this->input->post('id_akun');
		$no_rekening = $this->input->post('no_rekening');
		$nama_rekening = $this->input->post('nama_rekening');

		$data = array(
			'kode_bank' => $kode_bank,
			'no_rekening' => $no_rekening,
			'nama_rekening' => $nama_rekening,
			'id_akun' => $id_akun);
		$ubah = $this->rekening->ubah_rekening($data, $id_rekening);
		if($ubah){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}

		$respons = array('status' => $status);
		header("Content-type: application/json");
		echo json_encode($respons);
	}

	public function hapus_rekening()
	{
		$id_rekening = $this->input->post('id_rekening');
		$proses = $this->rekening->hapus_rekening($id_rekening);
		if($proses){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}

		$respons = array('status' => $status);
		header("Content-type: application/json");
		echo json_encode($respons);
	}
	// END BAGIAN REKENING

	public function ambil_data_lokasi_penjual()
	{
		$data_penjual = $this->penjual->ambil_semua_usaha();
		header("Content-type: application/json");
		echo json_encode($data_penjual->result_array(),JSON_PRETTY_PRINT);
	}

	public function getKendaraanByIdPenjual_html()
	{
		$id_usaha = $this->input->post('id_usaha');
		$where = 'id_usaha = ' . $id_usaha;
		$data = $this->kendaraan->getKendaraanBy($where);
		// echo $this->db->last_query();
		if($data->num_rows() > 0){
			$this->load->view('penjual/DataKendaraanPenjual', array('data' => $data));
			// $result = array('dataKendaraan' => $data->result_array(),
			// 				'responseMessage' => 'success',
			// 				'responseCode' => '00');
			// echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			echo 'kosong';
		}
	}

	public function getKendaraanById_JSON()
	{
		$id_kendaraan = $this->input->post('id_kendaraan');
		$where = 'id_kendaraan = ' . $id_kendaraan;
		$data = $this->kendaraan->getKendaraanBy($where);
		if($data->num_rows() > 0){
			$result = array('dataKendaraan' => $data->result_array(),
							'responseMessage' => 'success');
							echo json_encode($result, JSON_PRETTY_PRINT);
		}else{
			$result = array('dataKendaraan' => null,
							'responseMessage' => 'failed');
							echo json_encode($result, JSON_PRETTY_PRINT);
		}
	}

	public function UpdateKendaraanUsaha()
	{
		$id_kendaraan = $this->input->post('id_kendaraan');
		$jenis_kendaraan =  $this->input->post('jenis_kendaraan');
		$plat_kendaraan = $this->input->post('plat_kendaraan');
		$kapasitas_kendaraan = $this->input->post('kapasitas_kendaraan');
		$id_usaha = $this->input->post('id_usaha');
		// if($id==)

		$where = 'id_kendaraan = ' . $id_kendaraan;
		$data = array('jenis_kendaraan' => $jenis_kendaraan, 'plat_kendaraan' => $plat_kendaraan, 'kapasitas_kendaraan' => $kapasitas_kendaraan);
		$update = $this->kendaraan->updateKendaraan($data, $where);
		if($update){
			echo "success";
		}else{
			echo "failed";
		}
	}
}