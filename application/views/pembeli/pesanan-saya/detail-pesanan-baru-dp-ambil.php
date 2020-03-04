
  <div class="container-fluid">
    <div class="row">
      <div class="col s12">
        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1"><b>STATUS PEMESANAN<span class="secondary-content badge red accent-2 status-pemesanan white-text"  style="font-size: 15px; border-radius: 8px;"></span></b></li>
          </ul>
        </div>
        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="badge NoPesanan teal-text darken-4"></span></b></li>
            <li class="collection-item teal-text darken-1"><b>Waktu Pemesanan :<span class="badge WaktuPemesanan teal-text darken-4"></span></b></li>
          </ul>
        </div>

        <div class="card">
          <ul class="collection collection-product"></ul>
        </div>
        <div class="card">
            <ul class="collection">
              <li class="collection-item"><h5>DETAIL PENGIRIMAN</h5></li>
              <li class="collection-item">Jenis Pengiriman :<span class="secondary-content tipe-pengiriman"></span></li>
              <li class="collection-item">Tanggal Pengambilan :<span class="secondary-content tanggal-pengiriman"></span><br><span class="teal-text total-berat"></span></li>
          </ul>
        </div>
        <div class="card">
          <ul class="collection">
            <li class="collection-item"><h5>DETAIL PEMBAYARAN</h5></li>
            <li class="collection-item">Metode Pembayaran :<span class="secondary-content tipe-pembayaran"></span></li>
            <li class="collection-item">Total Harga Produk :<span class="secondary-content total-harga-produk"></span></li>
            <li class="collection-item teal-text darken-1"><b>Total Pembayaran :<span class="secondary-content total-pembayaran"></span></b></li>
            <li class="collection-item teal-text darken-1"><b>Minimal Transfer :<span class="secondary-content minimal-transfer"></span></b></li>
            <li class="collection-item teal-text darken-1"><b>Sisa Tagihan :<span class="secondary-content sisa-tagihan"></span></b></li>
          </ul>
        </div>
        <button class="waves-effect waves-light btn blue" type="button" style="width: 100%" onclick="LanjutkanPembayaran();">Lanjutkan Pembayaran</button>
        <button class="waves-effect waves-light btn red accent-2 modal-trigger" data-target="modal1" type="button" style="width: 100%; margin-top: 8px;">Batalkan Pesanan</button>

        <div id="modal1" class="modal small">
          <div class="modal-content">
            <h5 class="modal-title">Pembatalan Pesanan</h5>
            <p>Apakah Anda Yakin Ingin Membatalkan Pesanan ini?</p>
          </div>
          <div class="modal-footer">
            <button class="modal-close waves-effect waves-red btn transparent black-text" onclick="BatalkanPesanan()">Ya! Batalkan</button>
            <button class="modal-close waves-effect waves-teal btn green accent-5">Tidak</button>
          </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('.modal').modal();
  var DetailPesanan = storage.getItem("DetailPesanan");
  DetailPesanan = JSON.parse(DetailPesanan);
  $(document).ready(function(){
    var StatusPemesanan = storage.getItem("status");
    var IDPESANAN = DetailPesanan.ID;
    var TotalHargaAll = DetailPesanan.TotalHargaAll;
    var MinTransfer = TotalHargaAll * (30/100);
    var SisaTagihan = TotalHargaAll - MinTransfer;
    var BiayaPengiriman = DetailPesanan.BiayaPengiriman;
    var AllPurchaseProduk = DetailPesanan.AllPurchaseProduk;
    var waktuPemesanan = DetailPesanan.waktuPemesanan;
    var tglPengiriman = DetailPesanan.tglPengiriman;
    var TotalHargaProduk = DetailPesanan.TotalHargaProduk;
    var DataUsaha = DetailPesanan.DataUsaha;
    var DataPembeli = DetailPesanan.DataPembeli;
    var Alamat = DataPembeli.alamat_pb;
    var nama_usaha = DataUsaha.nama_usaha;
    var IdUsaha = DataUsaha.id_usaha;
    var JenisPengiriman = DetailPesanan.JenisPengiriman;
    var TanggalPengiriman = DetailPesanan.tglPengiriman;
    var TotalProdukPesanan = DetailPesanan.TotalProduk;
    var TotalBeratProduk = DetailPesanan.TotalBeratProduk * 10  * TotalProdukPesanan;
    console.log("TotalBeratProduk : " + TotalBeratProduk);
    var BiayaPengiriman = DetailPesanan.BiayaPengiriman;
    var DataPembayaran = DetailPesanan.DataPembayaran;
    var metode_pembayaran = DataPembayaran.metode_pembayaran;
    $(".status-pemesanan").attr("data-badge-caption", StatusPemesanan);
    $(".NoPesanan").html(IDPESANAN);
    $(".WaktuPemesanan").html(waktuPemesanan);
    var HtmlProduk = '';
    HtmlProduk += '<li class="collection-item"><h6 class="nama-toko">Nama Toko (Link Toko)</h6></li>'+
            '<li class="collection-item"><h5>DAFTAR PRODUK</h5></li>'
    $.each(AllPurchaseProduk, function(i,isi){
      var FotoProduk = base_url+ '/foto_usaha/produk/' + isi.foto_produk;
      var NamaProduk = isi.nama_produk + ' ' + isi.nama_variasi;
      var HargaProduk = isi.harga;
      var TotalProduk = isi.jml_produk;
      HtmlProduk += '<li class="collection-item avatar"><img src="'+FotoProduk+'" alt="" class="circle">'+
              '<span class="title">'+NamaProduk+'</span>'+
              '<p>Rp '+HargaProduk+'<br></p>'+
              '<span class="secondary-content"><b>'+TotalProduk+'&times;</b></span></li>';
    });
    HtmlProduk += '<b><a class="collection-item">Total Harga Produk :<span class="secondary-content total-harga-produk">Rp</span></a></b>';
    $(".collection-product").html(HtmlProduk);
    $(".nama-toko").html("<a href='#!' onclick='GoToDetailUsaha("+IdUsaha+")'>"+nama_usaha+"</a>");
    $(".alamat").html(Alamat);
    $(".tipe-pengiriman").html(JenisPengiriman);
    $(".tanggal-pengiriman").html(TanggalPengiriman);
    $(".total-berat").html(TotalBeratProduk+"&nbsp;Ons");
    $(".biaya-pengiriman").html("Rp " + formatNumber(BiayaPengiriman));
    $(".tipe-pembayaran").html(metode_pembayaran);
    $(".total-harga-produk").html("Rp&nbsp;" + formatNumber(TotalHargaProduk));
    $(".total-pembayaran").html("Rp&nbsp;" + formatNumber(TotalHargaAll));
    $(".minimal-transfer").html("Rp&nbsp;" + formatNumber(MinTransfer));
    $(".sisa-tagihan").html("Rp&nbsp;" + formatNumber(SisaTagihan));
  });

  function LanjutkanPembayaran(){

  }

  function BatalkanPesanan(){

  }

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
  }
</script>

<!-- <script type="text/javascript" src="../js/imgSlider.js"></script> -->
</body>
</html>