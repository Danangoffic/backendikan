<?php
/**
 * 
 */
class Model_pembayaran extends CI_Model
{
	
	public function createPembayaran($data)
    {
        return $this->db->insert('data_pembayaran', $data);
    }

    
    function updatePembayaran($data, $where)
    {
        return $this->db->update('data_pembayaran',$data,$where);
    }
}