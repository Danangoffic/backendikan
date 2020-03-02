<?php
/**
 * 
 */
class Model_pembeli extends CI_Model
{
	
	public function detail_pembeli($id_akun)
	{
		$this->db->select('*, latitude_pb as latitude, longitude_pb as longitude, alamat_pb as nama_tempat, id_pb as id_tempat');
		$this->db->from('data_pembeli');
		$this->db->where('id_pb =', $id_akun);
		return $this->db->get();
	}

	public function updateAlamat($data, $id_akun)
	{
		return $this->db->update('data_pembeli', $data, array('id_pb'=>$id_akun));
	}
}