<?php
/**
 * 
 */
class Model_penjual extends CI_Model
{
	public function ambil_data_penjual($username)
	{
		$this->db->select('*');
		$this->db->from('data_penjual a');
		$this->db->join('data_pengguna b', 'a.id_pj = b.id_akun');
		$this->db->where('b.username', $username);
		$this->db->limit(1);
		return $this->db->get();
	}

	public function ambil_semua()
	{
		$this->db->select('*');
		$this->db->from('data_penjual');
		return $this->db->get();
	}

	public function data_profile($id_pj)
	{
		$this->db->where('id_pj', $id_pj);
		return $this->db->get('data_penjual');
	}

	public function data_kel_tani_penjual($id_pj)
	{
		return $this->db->query("SELECT * FROM data_kelompok_tani_usaha a
					JOIN data_usaha b ON
					b.id_usaha = a.id_usaha
					JOIN data_kelompok_tani c ON
					a.id_kelompoktani = c.id_kelompoktani
					WHERE b.id_pj = '$id_pj';");
	}

	public function bandingkan_kel_tani_pj($id_pj, $id_kelompoktani)
	{
		return $this->db->query("SELECT * FROM data_kelompok_tani_usaha a
					JOIN data_usaha b ON
					b.id_usaha = a.id_usaha
					WHERE b.id_pj = '$id_pj' AND a.id_kelompoktani = '$id_kelompoktani' LIMIT 1;");
	}

	public function data_kelompok_tani()
	{
		$this->db->order_by('id_kelompoktani', 'asc');
		return $this->db->get('data_kelompok_tani');
	}

	public function ambil_semua_usaha()
	{
		return $this->db->get('data_usaha');
	}

	public function ambil_data_usaha($id_akun)
	{
		$this->db->where('id_pj',$id_akun);
		return $this->db->get('data_usaha');
	}

	public function ambil_data_usaha_with_pj($id_akun)
	{
		$this->db->select('*');
		$this->db->from('data_usaha a');
		$this->db->join('data_penjual b', 'a.id_pj = b.id_pj');
		$this->db->where('a.id_pj',$id_akun);
		return $this->db->get();
	}

	public function ambil_usaha_by_id($id_usaha)
	{
		$this->db->where('id_usaha',$id_usaha);
		return $this->db->get('data_usaha');
	}

	// JAM PENGIRIMAN USAHA
	public function ambil_jam_pengirman_usaha($id_usaha)
	{
		$this->db->where('id_usaha =', $id_usaha);
		return $this->db->get('data_jam_pengiriman');
	}

	public function insert_jam_pengiriman_usaha($data)
	{
		return $this->db->insert('data_jam_pengiriman', $data);
	}

	public function ubah_jam_pengiriman_usaha($data, $id_jampengiriman)
	{
		$this->db->where('id_jampengiriman =', $id_jampengiriman);
		return $this->db->update('data_jam_pengiriman', $data);
	}

	public function hapus_jam_pengiriman_usaha($id_jampengiriman)
	{
		$this->db->where('id_jampengiriman =', $id_jampengiriman);
		return $this->db->delete('data_jam_pengiriman');
	}
	// END PENGIRIMAN USAHA

	public function delete_kel_tani($id_usaha)
	{
		$this->db->where('id_usaha', $id_usaha);
		return $this->db->delete('data_kelompok_tani_usaha');
	}

	public function insert_tani_multi($data)
	{
		return $this->db->insert_batch('data_kelompok_tani_usaha', $data);
	}

	public function insert_tani($data)
	{
		return $this->db->insert('data_kelompok_tani_usaha', $data);
	}

	public function ambil_jam_pengiriman_usaha($id_usaha)
	{
		$this->db->where('id_usaha', $id_usaha);
		return $this->db->get('data_jam_pengiriman');
	}

	/*public function ambil_jam_pengiriman_usaha_by_id($id_jampengiriman)
	{
		$this->db->where('id_jampengiriman', $id_jampengiriman);
		return $this->db->get('data_jam_pengiriman');
	}

	public function ubah_jam_pengiriman_usaha($data, $id_jampengiriman)
	{
		$this->db->where('id_jampengiriman', $id_jampengiriman);
		return $this->db->update('data_jam_pengiriman', $data);
	}

	public function hapus_jam_pengiriman_usaha($id_jampengiriman)
	{
		$this->db->where('id_jampengiriman', $id_jampengiriman);
		return $this->db->delete('data_jam_pengiriman');
	}*/

	
}