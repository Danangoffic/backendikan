<?php
/**
 * 
 */
class Model_produk extends CI_Model
{
	public function ambil_produk_penjual($id_akun)
	{
		return $this->db->query("SELECT p.id_produk, p.nama_produk, p.kategori, p.foto_produk, p.berat_produk, p.min_pemesanan,  (SELECT MIN(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as minprice, (SELECT MAX(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as maxprice FROM data_produk p 
				JOIN data_variasi_produk vp ON p.id_produk = vp.id_produk
				JOIN data_usaha u ON p.id_usaha = u.id_usaha
				WHERE u.id_pj = '$id_akun'
				GROUP BY p.id_produk;");
	}

	public function ambil_produk_penjual_by_id($id_usaha)
	{
		$this->db->select('*, (SELECT MIN(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as minprice, (SELECT MAX(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as maxprice');
		$this->db->where_in('u.id_usaha', $id_usaha);
		$this->db->from('data_produk p');
		$this->db->join('data_usaha u', 'p.id_usaha = u.id_usaha');
		return $this->db->get();
	}

	public function insert_produk($data)
	{
		return $this->db->insert('data_produk', $data);
	}

	public function insert_variasi_multi($data)
	{
		return $this->db->insert_batch('data_variasi_produk', $data);
	}

	public function insert_variasi($data)
	{
		return $this->db->insert('data_variasi_produk', $data);
	}

	public function ambil_id_variasi($id_var)
	{
		return $this->db->query("SELECT id_variasi FROM data_variasi WHERE nama_variasi = '$id_Var' LIMIT 1;");
	}

	public function hapus($id_produk)
	{
		$this->db->where('id_produk', $id_produk);
		return $this->db->delete('data_produk');
	}

	public function ambil_data_by_id($id_produk)
	{
		$this->db->select('*, (SELECT MIN(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as minprice, (SELECT MAX(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as maxprice');
		$this->db->where('p.id_produk', $id_produk);
		$this->db->from('data_produk p');
		return $this->db->get();
	}

	public function ambil_data_by($id_produk, $variasi)
	{
		$this->db->select('*, (SELECT MIN(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as minprice, (SELECT MAX(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as maxprice, (select nama_variasi FROM data_variasi v join data_variasi_produk vp on vp.id_variasi = v.id_variasi WHERE vp.id_variasiproduk = '.$variasi.') as variasi');
		$this->db->where('p.id_produk', $id_produk);
		$this->db->from('data_produk p');
		return $this->db->get();
	}

	public function ambilVariasiProduk($idProduk, $Variasi)
	{
		$this->db->select("*");
		$this->db->from("data_produk a");
		$this->db->join("data_variasi_produk b", "b.id_produk = a.id_produk", "LEFT");
		$this->db->join("data_variasi c", "c.id_variasi = b.id_variasi", "left");
		$this->db->where("a.id_produk = ", $idProduk);
		$this->db->where("b.id_variasiproduk =", $Variasi);
		return $this->db->get();
	}

	public function ambilVariasiProdukById($id_variasiproduk)
	{
		$this->db->select("*");
		$this->db->from("data_produk a");
		$this->db->join("data_variasi_produk b", "b.id_produk = a.id_produk", "LEFT");
		$this->db->join("data_variasi c", "c.id_variasi = b.id_variasi", "left");
		$this->db->where("b.id_variasiproduk =", $id_variasiproduk);
		return $this->db->get();
	}

	public function ambil_var_by_produk($id_produk)
	{
		$this->db->where('id_produk', $id_produk);
		return $this->db->get('data_variasi_produk');
	}

	public function ambil_stok_variasi($id_variasiproduk)
	{
		$this->db->where('id_variasiproduk', $id_variasiproduk);
		$this->db->select('a.stok, a.harga, b.nama_variasi');
		$this->db->from('data_variasi_produk a');
		$this->db->join('data_variasi b', 'a.id_variasi = b.id_variasi', 'left');
		return $this->db->get();
	}

	public function ambil_data_variasi()
	{
		return $this->db->query("SELECT * FROM data_variasi ORDER BY id_variasi;");
	}

	public function ambil_variasi_produk($id_produk, $id_variasi)
	{
		$this->db->where('id_produk', $id_produk);
		$this->db->where('id_variasi', $id_variasi);
		return $this->db->get('data_variasi_produk');
	}

	public function ambil_variasi_produk2($id_produk)
	{
		$this->db->select('vp.id_variasiproduk, vp.harga, p.nama_produk, p.id_produk, vp.id_variasi, v.nama_variasi');
		$this->db->from('data_variasi_produk vp');
		$this->db->join('data_produk p', 'vp.id_produk = p.id_produk');
		$this->db->join('data_variasi v', 'vp.id_variasi = v.id_variasi');
		$this->db->where('p.id_produk', $id_produk);
		return $this->db->get();
	}

	public function ubah_produk($data, $id_produk)
	{
		$this->db->where('id_produk',$id_produk);
		return $this->db->update('data_produk', $data);
	}

	public function hapus_variasi_produk($id_produk)
	{
		$this->db->where('id_produk', $id_produk);
		return $this->db->delete('data_variasi_produk');
	}

	public function hapus_variasi_produk_by_id($id_variasiproduk)
	{
		$this->db->where('id_variasiproduk', $id_variasiproduk);
		return $this->db->delete('data_variasi_produk');
	}

	public function ambil_variasi_by_id($id_var)
	{
		$this->db->select('vp.id_variasiproduk, vp.harga, vp.id_variasi');
		$this->db->from('data_variasi_produk vp');
		$this->db->join('data_produk p', 'vp.id_produk = p.id_produk');
		$this->db->where('vp.id_variasiproduk', $id_var);
		return $this->db->get();
	}

	public function cek_variasi($id_var, $id_Var2)
	{
		$this->db->select('vp.id_variasiproduk, vp.harga, vp.id_variasi');
		$this->db->from('data_variasi_produk vp');
		$this->db->join('data_produk p', 'vp.id_produk = p.id_produk');
		$this->db->where('vp.id_variasiproduk', $id_var);
		$this->db->where('vp.id_variasi', $id_var2);
		return $this->db->get();
	}

	public function update_variasi($data, $id_variasiproduk)
	{
		$this->db->where('id_variasiproduk', $id_variasiproduk);
		return $this->db->update('data_variasi_produk', $data);
	}

	public function ambil_img_slider_produk()
	{
		$this->db->select('id_produk, nama_produk, foto_produk, id_usaha');
		$this->db->limit(3);
		return $this->db->get('data_produk');
	}

	public function ambil_produk_kategori($kategori)
	{
		$this->db->select('*, (SELECT MIN(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as minprice, (SELECT MAX(harga) FROM `data_variasi_produk` WHERE id_produk = p.id_produk) as maxprice');
		$this->db->where('kategori', $kategori);
		return $this->db->get('data_produk p');
	}

	public function updateStokProdukFromPemesanan($idVariasiProduk,$stokUsed)
	{
		return $this->db->query("UPDATE data_variasi_produk SET stok = (stok-".$stokUsed.") WHERE id_variasiproduk = '".$idVariasiProduk."' LIMIT 1");
	}

	public function getVariasiProdukByIdProdukIdVariasi($idProduk, $idVariasi)
	{
		$this->db->where('id_produk', $idProduk);
		$this->db->where('id_variasi', $idVariasi);
		$this->db->limit(1);
		return $this->db->get('data_variasi_produk');
	}
}