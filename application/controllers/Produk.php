<?php
/**
 * 
 */
class Produk extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		// header("'Access-Control-Allow-Credentials' : true");
		$this->load->model("Model_produk", "produk");
		$this->load->model("Model_penjual", "penjual");
	}

	public function index()
	{
		exit("The Page Are Not Allowed!");
	}

	public function ambil_produk_penjual()
	{
		$id_akun = $this->input->post('id_akun');
		// echo $id_akun;
		$data_produk = $this->produk->ambil_produk_penjual($id_akun);
		$ambil_data = $data_produk->result_array();
		$response = array();
		if($data_produk->num_rows() > 0):
			$response = $data_produk;
			header("Content-type: application/json");
			echo json_encode($ambil_data);
		else:
			echo json_encode($response);
		endif;
	}

	public function ambil_produk_penjual_by_id()
	{
		$id_usaha = $this->input->post('id_usaha');
		$data_produk = $this->produk->ambil_produk_penjual_by_id($id_usaha);
		$data = $data_produk->result();
		header("Content-type: application/json");
		echo json_encode($data);
	}

	public function prosesinput_produk()
	{
		$nama_produk = $this->input->post['nama_produk'];
		$kategori = $this->input->post['Kategori'];
		
		$harga_produk = $this->input->post['harga_produk'];
		$berat_produk = $this->input->post['berat_produk'];
		$minOrder = $this->input->post['minOrder'];
		$id_akun = $this->input->post['id_akun'];
		$variasi = ($_POST['variasi']) ? $_POST['variasi'] : '';
		$variasi = explode(',', $variasi);


		// SETTING UPLOAD FOTO
		$config['upload_path']          = './foto_toko/produk/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('fotoProduk')){
			$dataFoto = array('error' => $this->upload->display_errors());
		}else{
			$dataFoto = array('upload_data' => $this->upload->data());
		}
		$foto_produk		=  date('dmYHis') . $dataFoto['file_name'];
		// END UPLOAD FOTO

		$data_usaha = $this->penjual->ambil_data_usaha($id_akun);
		$get_usaha = $data_usaha->row_array();
		$id_usaha = $get_usaha['id_usaha'];

		$array_produk = array(
			'nama_produk' =>$nama_produk,
			'kategori' => $kategori,
			'foto_produk' => $fotoProduk,
			'berat_produk' => $berat_produk,
			'min_pemesanan' => $minOrder,
			'id_usaha' => $id_usaha);
		$insert_produk = $this->produk->insert($array_produk);
		if($insert_produk){
			$id_produk = $this->db->insert_id();

			$total_var = count($variasi);

			// CHECK IF VARIASI > 0
			if ($total_var > 0) {
		        // CEK JIKA TOTAL VAR > 1
				if($total_var > 1){
					// LOOPING FOR VARIASI
					for ($i = 0; $i < $total_var; $i++) {
						$id_Var = $variasi[$i];
						$id_variasi = $this->produk->ambil_id_variasi($id_Var)->row()->id_variasi;
						$query2[]= array(
							'id_produk' => $id_produk,
							'id_variasi' => $id_variasi,
							'harga' => $harga_produk);;
					}
		        // EXECUTE INSERT VARIASI
					$insert = $this->produk->insert_variasi_multi($query2);
				// CEK JIKA VAR == 1
				}elseif($total_var==1){
					$id_variasi = $this->produk->ambil_id_variasi($id_Var)->row()->id_variasi;
					$query2= array(
						'id_produk' => $id_produk,
						'id_variasi' => $id_variasi,
						'harga' => $harga_produk);
					// EXECUTE INSERT VARIASI
					$insert = $this->produk->insert_variasi($query2);
				}
			        
			}

			if ($insert) {
				$status = 'Berhasil Menambahkan Produk Dengan Variasi';
			} else {
				echo $koneksi->error . '<br>';
				$status = 'Berhasil Menambahkan Produk, Tetapi Gagal Menambahkan Variasi';
				echo $status;
				exit();
			}
		} else {
			$status = 'Berhasil Menginput Produk';
		}
		$response = array(
			'status' => $status
		);

		header("Content-type:application/json");
		echo json_encode($response);
	}

	public function ambil_data_produk_update()
	{
		$id_produk = $this->input->post('id_produk');
		$data = $this->produk->ambil_data_by_id($id_produk);
		if($data->num_rows() > 0){
			$produk = $data->row_array();
		}else{
			$produk = array();
		}
		header("Content-type:application/json");
		echo json_encode($produk);
	}

	public function ambil_data_variasi()
	{
		$id_produk = $this->input->post('id_produk');
		$ambil_data_variasi = $this->produk->ambil_data_variasi($id_produk);
		if($ambil_data_variasi->num_rows() > 0){
			foreach ($ambil_data_variasi->result_array() as $dv) {
				$produk_var = $this->produk->ambil_variasi_produk($id_produk, $dv['id_variasi']);
				// echo $this->db->last_query();
				if($produk_var->num_rows() > 0){
					$SELECT = 'checked';
				}else{
					$SELECT = '';
				}
				$data[] = array('id'=>$dv['id_variasi'], 'text'=>$dv['nama_variasi'], 'selected' => $SELECT);
			}
		}else{
			$data = array();
		}
		header("Content-type:application/json");
		echo json_encode($data);
	}

	public function prosesupdate_produk()
	{
		$id_produk			= $this->input->post('id_produk');
		$nama_produk		= $this->input->post('nama_produk');
		$berat_produk		= $this->input->post('berat_produk');
		$id_toko			= $this->input->post('id_toko');
		$min_pemesanan		= $this->input->post('minOrder');
		// $variasi			= ($_POST['variasi']) ? $_POST['variasi'] : [];
		$variasi			= $this->input->post('variasi');

		// SETTING UPLOAD FOTO
		$foto_name = date('dmYHis').$_FILES['fotoProduk']['name'];
		$config['upload_path']          = './foto_usaha/produk/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 20480;
		$config['max_width']            = 5000;
		$config['max_height']           = 5000;
		$config['file_name']			= $foto_name;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('fotoProduk')){
			$dataFoto = array('error' => $this->upload->display_errors());
			$datafoto_produk = $this->produk->ambil_data_by_id($id_produk)->row();
			$foto_produk	= $datafoto_produk->foto_produk;
			// echo "Gagal";
			// var_dump($dataFoto);
			// ->row()->foto_produk
			// echo $this->db->last_query();
		}else{
			$dataFoto			= array('upload_data' => $this->upload->data());
			// var_dump($dataFoto);
			$foto_produk		=  $dataFoto['upload_data']['file_name'];
		}
		// exit();
		// END UPLOAD FOTO
		$data_update = array(
			'nama_produk' => $nama_produk,
			'foto_produk' => $foto_produk,
			'berat_produk' => $berat_produk,
			'min_pemesanan' => $min_pemesanan
		);
		$update = $this->produk->ubah_produk($data_update, $id_produk);
		// echo $this->db->last_query();
		
		if($update){
			$status = 'berhasil';
		}else{
			$status = 'Gagal Mengubah Data Produk';
		}
		$response = array(
			'status' => $status
		);

		header("Content-type:application/json");
		echo json_encode($response);
	}

	public function hapus_data_produk()
	{
		$id_produk = $this->input->post('produk');
		$hapus_var_produk = $this->produk->hapus_variasi_produk($id_produk);
		if($hapus_var_produk){
			$foto_produk = $this->produk->ambil_data_by_id($id_produk)->row()->foto_produk;
			$path = './foto_toko/produk/';
			if(delete_file($path.$foto_produk)){
				$hapus = $this->produk->hapus($id_produk);
				if($hapus) {
					$status = 'berhasil';
				} else {
		// $status = $koneksi->error();
					$status = 'gagal';
				}	
			}else{
				$status = 'gagal';
			}
			
		}else{
			$status = 'gagal';
		}
		

		$response = array(
			'status' => $status
		);

		echo json_encode($response);
	}

	public function detail_produk()
	{
		$id_produk = $this->input->post('id_produk');
		$data = $this->produk->ambil_data_by_id($id_produk);
		$result = $data->row_array();
		echo json_encode($result);
	}

	public function detail_produk_variasi()
	{
		$id_produk = $this->input->post('id_produk');
		$variasi = $this->input->post('variasi');
		$data = $this->produk->ambilVariasiProduk($id_produk, $variasi);
		$result = $data->row_array();
		echo json_encode($result);
	}

	public function ambil_stok_variasi()
	{
		$variasi = $this->input->post('variasi');
		$data_stok = $this->produk->ambil_stok_variasi($variasi);
		if($data_stok->num_rows() > 0){
			echo json_encode($data_stok->row());
		}else{
			echo "{}";
		}
		header("Content-type: Applicatoin/json");
	}

	public function detail_var_produk()
	{
		$id_produk = $this->input->post('id_produk');
		$data = $this->produk->ambil_var_by_produk($id_produk);
		$result = $data->row_array();
		echo json_encode($result);
	}

	public function updatevariasi_produk()
	{
		$id_produk = $this->input->post('id_produk');
		$variasi = ($this->input->post('dVariasi')) ? $this->input->post('dVariasi') : [];
		$harga = $this->input->post('harga');
		if(count($variasi) > 0){
			$insert_variasi = $this->produk->insert_variasi($data);
		}
	}

	public function ambil_variasi_produk2()
	{
		$id_produk = $this->input->post('id_produk');
		$data = $this->produk->ambil_variasi_produk2($id_produk);
		$result = $data->result_array();
		header("Content-type:application/json");
		echo json_encode($result);
	}

	public function ambil_variasi_by_id()
	{
		$id_var = $this->input->post('id_var');
		$data = $this->produk->ambil_variasi_by_id($id_var);
		$result = $data->row_array();
		header("Content-type:application/json");
		echo json_encode($result);
	}

	public function cek_variasi_var()
	{
		$id_produk = $this->input->post('id_produk');
		$id_var = $this->input->post('var');
		$ambil_data_variasi = $this->produk->ambil_data_variasi();
		if($ambil_data_variasi->num_rows() > 0){
			foreach ($ambil_data_variasi->result_array() as $dv) {
				$produk_var = $this->produk->ambil_variasi_by_id($id_var, $dv['id_variasi']);
				// echo $this->db->last_query();
				if($produk_var->num_rows() > 0){
					$SELECT = 'checked';
				}else{
					$SELECT = '';
				}
				$data[] = array('id'=>$dv['id_variasi'], 'text'=>$dv['nama_variasi'], 'selected' => $SELECT);
			}
		}else{
			$data = array();
		}
		header("Content-type:application/json");
		echo json_encode($data);
	}

	public function updatevariasi_produk2()
	{
		$variasi = $this->input->post('variasi');
		$harga = $this->input->post('harga');
		$id_variasiproduk = $this->input->post('id_variasiproduk');

		$data = array('id_variasi' => $variasi, 'harga' => $harga);
		$update = $this->produk->update_variasi($data, $id_variasiproduk);
		if($update){
			$status = 'berhasil';
		}else{
			$status = 'gagal';
		}
		$response = array('status' => $status);
		header("Content-type:application/json");
		echo json_encode($response);
	}

	public function tambahvariasi_produk()
	{
		$id_produk = $this->input->post('id_produk');
		$variasi = $this->input->post('variasi');
		$harga = $this->input->post('harga');

		$data = array('id_produk' => $id_produk, 'id_variasi' => $variasi, 'harga' => $harga);
		$tambah = $this->produk->insert_variasi($data);
		if($tambah){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}
		$response = array('status' => $status);
		header("Content-type:application/json");
		echo json_encode($response);
	}

	public function hapus_variasi_by_id()
	{
		$id_variasiproduk = $this->input->post('id_var');
		$hapus = $this->produk->hapus_variasi_produk_by_id($id_variasiproduk);
		if($hapus){
			$status = "berhasil";
		}else{
			$status = "gagal";
		}
		$response = array('status' => $status);
		header("Content-type:application/json");
		echo json_encode($response);
	}

	public function get_image_slider()
	{
		$data = $this->produk->ambil_img_slider_produk();
		$response = array();
		if($data->num_rows() > 0){
			$response = array('data' => $data->result_array(), 'max' => $data->num_rows());
		}else{
			$response = array('data' => null);
		}
		header("X-Content-Type-Options: nosniff");
		header("Content-type: application/json");
		echo json_encode($response);
	}

	public function get_all()
	{
		# code...
	}

	public function ambil_produk_kategori()
	{
		$kategori = $this->input->post('kat');
		$data = $this->produk->ambil_produk_kategori($kategori);
		$response = array();
		if($data->num_rows() > 0){
			$response = $data->result_array();
		}

		header("Content-type: application/json");
		echo json_encode($response);
	}

	public function all_produk()
	{
		echo "ALL PRODUK";
	}

	

	
}