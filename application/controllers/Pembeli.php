<?php
/**
 * 
 */
class Pembeli extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		$this->load->model("Model_pembeli", "Pembeli");
		
	}

	public function detail_pembeli()
	{
		$id_akun = $this->input->post('id_akun');
		$data_pembeli = $this->Pembeli->detail_pembeli($id_akun);
		$data[] = $data_pembeli->row();
		// header("Content-type: application/json");
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	public function updateAlamat()
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

	public function ViewUbahProfile()
	{
		$dataProfile = $this->input->post('dataProfile');
		$dataProfile = json_decode($dataProfile);
		$dataProfile = $dataProfile[0];
		$this->load->view('pembeli/ubah-profile', $dataProfile);

	}
	
}