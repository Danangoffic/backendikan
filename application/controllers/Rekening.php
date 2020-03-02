<?php
/**
 * 
 */
class Rekening extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		$this->load->model('Model_rekening', 'rekening');
	}

	public function ambil_data_bank()
	{
		$data = $this->rekening->ambil_semua();
		$hasil = $data->result_array();
		header("Content-type: application/json");
		echo json_encode($hasil);
	}

	public function uploadBukti_ambilBank_html()
	{
		$id_akun = $this->input->post('id_akun');
		$data = $this->rekening->ambil_semua();
		// $respons = $data->result_array();
		// header("Content-type: text/html");
		$this->load->view("rekening/unggahBukti_ambilBank_html", array('dataRekening' => $data));
		// echo json_encode($respons);
	}
}