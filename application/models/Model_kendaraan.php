<?php
/**
 * 
 */
class Model_kendaraan extends CI_Model
{
	
	public function createKendaraan($data)
    {
        return $this->db->insert('data_kendaraan', $data);
    }

    
    function updateKendaraan($data, $where)
    {
        $this->db->where($where);
        return $this->db->update('data_kendaraan',$data);
    }

    public function getKendaraanBy($where)
    {
        $this->db->where($where);
        return $this->db->get("data_kendaraan");
    }
}