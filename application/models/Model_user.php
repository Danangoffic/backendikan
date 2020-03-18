<?php
/**
 * 
 */
class Model_user extends CI_Model
{
	public function cek_pengguna($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->limit(1);
		return $this->db->get('data_pengguna');
	}

	public function updateUser($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('data_pembeli', $data);
	}
}