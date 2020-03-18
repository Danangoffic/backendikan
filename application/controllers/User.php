<?php
/**
 * 
 */
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		$this->load->model("Model_user", 'user');
	}

	public function proseslogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek = $this->user->cek_pengguna($username, $password);
		if($cek->num_rows() > 0){
			$status = 'berhasil';
			$data_pengguna = $cek->row_array();
			$id_akun = $data_pengguna['id_akun'];
			$usergroup = $data_pengguna['level_user'];
			$set_data = array(
						'username' => $data_pengguna['username'],
						'id_akun' => $id_akun);
			$this->session->set_userdata($set_data);
		}else{
			$status = 'gagal';
			$usergroup = '';
			$id_akun = '';
		}
		$response = array(
			'username' => $username,
			'status' => $status,
			'usergroup' => $usergroup,
			'id_akun' => $id_akun
		);
		echo json_encode($response);
	}

	// PROSES DAFTAR PENJUAL
	public function prosessignuppenjual($value='')
	{
		$username		= $_POST['username'];
		$password	 	= $_POST['password'];
		$nama_pj		= $_POST['nama_pj'];
		$noktp_pj		= $_POST['noktp_pj'];
		$jk_pj			= $_POST['jk_pj'];
		$tgllahir_pj 	= $_POST['tgllahir_pj'];
		$alamat_pj		= $_POST['alamat_pj'];
		$telp_pj		= $_POST['telp_pj'];
		$jenis_petani	= $_POST['jenis_petani'];

		$nama_toko		= $_POST['nama_toko'];
		$alamat_toko	= $_POST['alamat_toko'];
		$jml_kolam 		= ($_POST['jml_kolam']) ? $_POST['jml_kolam'] : 0;
		$jml_kapal		= ($_POST['jml_kolam']) ? $_POST['jml_kolam'] : 0;
		$kapasitas_kapal = ($_POST['kapasitas_kapal']) ? $_POST['kapasitas_kapal'] : 0;
		$kab_toko 		= $_POST['kab_toko'];
		$kec_toko 		= $_POST['kec_toko'];
		$kel_toko 		= $_POST['kel_toko'];
		$longitude 		= $_POST['longitude'];
		$latitude 		= $_POST['latitude'];

		if (is_array($_FILES)) {
			if (is_uploaded_file($_FILES['foto_pj']['tmp_name'])) {
				$sourcePath2 = $_FILES['foto_pj']['tmp_name'];
				$foto_pj = date('dmYHis') . $_FILES['foto_pj']['name'];
				$targetPath2 = "./foto_penjual/" . $foto_pj;
				move_uploaded_file($sourcePath2, $targetPath2);
			} if (is_uploaded_file($_FILES['fotoktp_pj']['tmp_name'])) {
				$sourcePath2 = $_FILES['fotoktp_pj']['tmp_name'];
				$fotoktp_pj = date('dmYHis') . $_FILES['fotoktp_pj']['name'];
				$targetPath2 = "./foto_ktp_penjual/" . $fotoktp_pj;
				move_uploaded_file($sourcePath2, $targetPath2);
			} if (is_uploaded_file($_FILES['foto_toko']['tmp_name'])) {
				$sourcePath2 = $_FILES['foto_toko']['tmp_name'];
				$foto_toko = date('dmYHis') . $_FILES['foto_toko']['name'];
				$targetPath2 = "./foto_toko/" . $foto_toko;
				move_uploaded_file($sourcePath2, $targetPath2);
			}
		}

		// exit();

		$query = "INSERT INTO data_penjual VALUES (NULL,'$nama_pj', '$foto_pj', '$noktp_pj', '$fotoktp_pj', '$jk_pj', '$tgllahir_pj', '$alamat_pj', '$telp_pj', '$jenis_petani')";
		$insert = $this->db->query($query);

		if($insert) {
			$last_id_pj = $this->db->insert_id();
			$query2 = "INSERT INTO data_usaha VALUES (null, '$nama_toko', '$foto_toko', '$alamat_toko', '$jml_kapal', '$kapasitas_kapal', '$jml_kolam', '$kab_toko', '$kec_toko', '$kel_toko', '0', '0', '$last_id_pj')";
			$insert2 = $this->db->query($query2);
			if($insert2){
				$query3 = "INSERT INTO data_pengguna VALUES (null, '$username', '$password', '$last_id_pj', 'penjual')";
				$insert3 = $this->db->query($query3);
				if($insert3){
					$status = 'berhasil';
				}else{
					$status = 'gagal3 . ' . $this->db->_error_message();
				}
			}else{
				$status = 'gagal2 . ' . $this->db->_error_message();
			}
		} else {
			$status = 'gagal1';
		}

		$response = array(
			'status' => $status
		);

		echo json_encode($response);
	}

	// PROSES DAFTAR PEMBELI
	public function prosessignuppembeli()
	{
		$username		= $_POST['username'];
		$password	 	= $_POST['password'];
		$nama_pb		= $_POST['nama_pb'];
		//$foto_pb		= $_POST['foto_pb'];
		// $noktp_pj		= $_POST['noktp_pj'];
		// $fotoktp_pj		= $_POST['fotoktp_pj'];
		$jk_pb			= $_POST['jk_pb'];
		$tgllahir_pb 	= $_POST['tgllahir_pb'];
		$telp_pb		= $_POST['telp_pb'];
		$alamat_pb		= $_POST['alamat_pb'];
		$kab_pb			= $_POST['kab_pb'];
		$kec_pb			= $_POST['kec_pb'];
		$kel_pb			= $_POST['kel_pb'];
		$longitude_pb 	= $_POST['longitude_pb'];
		$latitude_pb 	= $_POST['latitude_pb'];
		if (is_array($_FILES)) {
			if (is_uploaded_file($_FILES['foto_pb']['tmp_name'])) {

				$sourcePath2 = $_FILES['foto_pb']['tmp_name'];
				$foto_pb = date('dmYHis') . $_FILES['foto_pb']['name'];
				$targetPath2 = "./foto_pembeli/" . $foto_pb;
				move_uploaded_file($sourcePath2, $targetPath2);
			}
		}

		$query = "INSERT INTO data_pembeli VALUES (NULL,'$nama_pb', '$foto_pb', '$jk_pb', '$tgllahir_pb', '$telp_pb', '$alamat_pb', '$kab_pb', '$kec_pb', '$kel_pb', '$latitude_pb', '$longitude_pb')";
		$insert = $this->db->query($query);

		if($insert) {
			$last_id_pj = $this->db->insert_id();
			$query2 = "INSERT INTO `data_pengguna` VALUES (null, '$username', '$password', '$last_id_pj', 'pembeli')";
			$insert2 = $this->db->query($query2);
			if($insert2){
				$status = 'berhasil';
			} else{
				$status = 'gagal2 . ' . $this->db->_error_message();
			}
		} else {
			$status = 'gagal1';
		}

		$response = array(
			'status' => $status
		);

		echo json_encode($response);
	}

	public function prosesupdatepembeli()
	{
		$nama_pb		= $_POST['nama_pb'];
		//$foto_pb		= $_POST['foto_pb'];
		// $noktp_pj		= $_POST['noktp_pj'];
		// $fotoktp_pj		= $_POST['fotoktp_pj'];
		$jk_pb			= $_POST['jk_pb'];
		$tgllahir_pb 	= $_POST['tgllahir_pb'];
		$telp_pb		= $_POST['telp_pb'];
		$alamat_pb		= $_POST['alamat_pb'];
		$kab_pb			= $_POST['kab_pb'];
		$kec_pb			= $_POST['kec_pb'];
		$kel_pb			= $_POST['kel_pb'];
		$longitude_pb 	= $_POST['longitude'];
		$latitude_pb 	= $_POST['latitude'];
		$id_akun		= $this->input->post('idAkun');
		if (is_array($_FILES)) {
			if (is_uploaded_file($_FILES['foto_pb']['tmp_name'])) {

				$sourcePath2 = $_FILES['foto_pb']['tmp_name'];
				$foto_pb = date('dmYHis') . $_FILES['foto_pb']['name'];
				$targetPath2 = "./foto_pembeli/" . $foto_pb;
				move_uploaded_file($sourcePath2, $targetPath2);
			}
		}

		$dataUpdate = array(
			'nama_pb' => $nama_pb,
			'foto_pb' => $foto_pb,
			'jk_pb' => $jk_pb,
			'tgllahir_pb' => $tgllahir_pb,
			'telp_pb' => $telp_pb,
			'alamat_pb' => $alamat_pb,
			'kab_pb' => $kab_pb,
			'kec_pb' => $kec_pb,
			'kel_pb' => $kel_pb,
			'latitude_pb' => $latitude_pb,
			'longitude_pb' => $longitude_pb
		);
		$where = "id_pb = '$id_akun'";

		$updatee = $this->user->updateUser($dataUpdate, $where);

		if($updatee) {
			// $query2 = "INSERT INTO `data_pengguna` VALUES (null, '$username', '$password', '$last_id_pj', 'pembeli')";
			// $insert2 = $this->db->query($query2);
			// if($insert2){
				$status = 'berhasil';
			// } else{
			// 	$status = 'gagal2 . ' . $this->db->_error_message();
			// }
		} else {
			$status = 'gagal';
		}

		$response = array(
			'status' => $status
		);

		echo json_encode($response);
	}
}