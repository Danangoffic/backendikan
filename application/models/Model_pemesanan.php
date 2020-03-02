<?php
/**
 * 
 */
class Model_pemesanan extends CI_Model
{
	
	public function createPemesanan($data)
    {
        return $this->db->insert('data_pemesanan', $data);
    }

    public function createDetailPemesanan_batch($data)
    {
        return $this->db->insert_batch('data_detail_pemesanan', $data);
    }

    public function createDetailPemesanan($data)
    {
        return $this->db->insert('data_detail_pemesanan', $data);
    }

    public function getDataPemesananByIdUser($idUser,$limit=null, $orderBy=null,$typeOrder=null)
    {
        $this->db->where('id_pb=',$idUser);
        if($limit!=null){
            $this->db->limit($limit);
        }
        if($orderBy!=null){
            if($typeOrder!=null){
                $this->db->order_by($orderBy, $typeOrder);
            }else{
                $this->db->order_by($orderBy, "ASC");
            } 
        }
        return $this->db->get('data_pemesanan');
    }

    public function getDataPemesananByIdUserAndStatus($idUser, $status,$limit=null, $orderBy=null,$typeOrder=null)
    {
        $this->db->where('id_pb=',$idUser);
        $this->db->where('status_pemesanan', $status);
        if($limit!=null){
            $this->db->limit($limit);
        }
        if($orderBy!=null){
            if($typeOrder!=null){
                $this->db->order_by($orderBy, $typeOrder);
            }else{
                $this->db->order_by($orderBy, "ASC");
            } 
        }
        return $this->db->get('data_pemesanan');
    }

    public function getDetailPemesanan($idPemesanan)
    {
        $this->db->select('ddp.harga, dp.nama_produk, ddp.jml_produk, dv.nama_variasi, dp.id_produk, dp.foto_produk, ddp.sub_total, dp.berat_produk');
        $this->db->from('data_detail_pemesanan ddp');
        $this->db->join('data_variasi_produk dvp', 'ddp.id_produk = dvp.id_variasiproduk');
        $this->db->join('data_produk dp', 'dvp.id_produk = dp.id_produk');
        $this->db->join('data_variasi dv', 'dvp.id_variasi = dv.id_variasi');
        $this->db->where('id_pemesanan =',$idPemesanan);
        return $this->db->get();
    }

    public function getDataPembayaranByIdPemesanan($idPemesanan)
    {
        $this->db->where('id_pemesanan' ,$idPemesanan);
        $this->db->limit(1);
        return $this->db->get('data_pembayaran');
    }

    public function updatePemesanan($data, $where)
    {
        return $this->db->update('data_pemesanan', $data, $where, 1);
    }

    public function getHargaPemesananByIdPemesanan($idPemesanan){
        $this->db->select('total_harga');
        $this->db->where('id_pemesanan =', $idPemesanan);
        $this->db->from('data_pemesanan');
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getStatus($id_pemesanan)
    {
        $this->db->select("*");
        $this->db->from('data_pemesanan');
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getDataPembayaranOnlyByIdPemesanan($id_pemesanan)
    {
        $this->db->where("id_pemesanan", $id_pemesanan);
        $this->db->limit(1);
        return $this->db->get("data_pembayaran");
    }

    public function getDetailDataPembayaranByIdPemesanan($id_pemesanan)
    {
        $this->db->select('*');
        $this->db->from("data_pembayaran dp");
        $this->db->join('data_master_bank dmb', "dp.id_bank = dmb.kode_bank");
        $this->db->where("dp.id_pemesanan", $id_pemesanan);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function UpdatePembayaran($data, $id_pemesanan)
    {
        $this->db->where('id_pemesanan', $id_pemesanan);
        return $this->db->update("data_pembayaran", $data);
    }

    public function DeletePembayaran($where)
    {
        return $this->db->delete("data_pembayaran", $where);
    }

    public function DeleteDetailPemesanan($where)
    {
        return $this->db->delete("data_detail_pemesanan", $where);
    }

    public function DeletePemesanan($where)
    {
        return $this->db->delete("data_pemesanan", $where);
    }


}