
  <div class="container-fluid">
    <div class="row" style="margin-bottom: -30px">
      <div class="col s12">
        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1">
              <b>STATUS PEMESANAN <span class="secondary-content badge green white-text" style="font-size: 15px; border-radius: 8px">DIKEMAS</span></b>
            </li>
          </ul>
        </div>
        
        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="secondary-content NoPesanan">310120181025</span></b></li>
            <li class="collection-item">Waktu Pemesanan :<span class="secondary-content WaktuPemesanan">31/01/2020 23:00</span></li>
            <li class="collection-item">Waktu Pembayaran :<span class="secondary-content WaktuPembayaran">31/01/2020 23:30</span></li>
          </ul>
        </div>

        <!-- <a class="collection-item" href="#!"><h6 class="nama-toko">Nama Toko (Link Toko)</h6></a> -->
        <div class="card">
          <ul class="collection collection-product"></ul>
        </div>
        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="collection">
                <ul class="collection-header" style="padding-left: 10px"><h6>DETAIL PENGIRIMAN</h6></ul>
                <ul class="collection-item">Jenis Pengiriman :<span class="badge tipe-pengiriman">Ambil di Toko</span></ul>
                <ul class="collection-item">Tanggal Pengambilan yang Diajukan :<span class="badge tanggal-pengiriman">02/01/2020</span></ul>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: -30px; margin-bottom: -10px">
        <div class="col s12">
          <div class="card">
            <div class="collection">
              <ul class="collection-header" style="padding-left: 10px"><h6>DETAIL PEMBAYARAN</h6></ul>
              <ul class="collection-item">Metode Pembayaran :<span class="badge tipe-pembayaran">Bayar Penuh Tunai</span></ul>
              <a class="collection-item">Total Harga Produk :<span class="badge total-harga-produk">Rp</span></a>
              <h6><b><a class="collection-item" style="margin-bottom: -5px">Total Pembayaran :<span class="badge total-pembayaran">Rp</span></b>
              </h>  
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="collection red darken-3 white-text">
        <p class="flow-text center">Silahkan ambil produk sesuai <br><b>TANGGAL PENGAMBILAN</b> <br>dan melakukan pembayaran sebesar <br><b>TOTAL PEMBAYARAN</b> secara langsung ke <b>PENJUAL</b></p>
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
    $(".status-pemesanan").html(StatusPemesanan);
    $(".NoPesanan").html(IDPESANAN);
    $(".WaktuPemesanan").html(waktuPemesanan);
    
    var HtmlProduk = '';
    HtmlProduk = '<li class="collection-item"><a href=""><h6 class="nama-toko"></h6></a></li>'+
                  '<li class="collection-item"><h5>DAFTAR PRODUK</h5></li>';
    $.each(AllPurchaseProduk, function(i,isi){
      var FotoProduk = base_url+ '/foto_usaha/produk/' + isi.foto_produk;
      var NamaProduk = isi.nama_produk + ' ' + isi.nama_variasi;
      var HargaProduk = isi.harga;
      var TotalProduk = isi.jml_produk;
      HtmlProduk += '<li class="collection-item avatar"><img src="'+FotoProduk+'" alt="" class="circle">'+
              '<span class="title">'+NamaProduk+'</span>'+
              '<p>Rp '+HargaProduk+'<br></p>'+
              '<span class="secondary-content">'+TotalProduk+'&times;</span></li>';
    });
    HtmlProduk += '<li class="collection-item teal-text darken-1"><b>Total Harga Produk: <span class="secondary-content total-harga-produk"></span></b></li>';
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
    console.log("Lanjutkan Pembayaran");
    window.location.href = "pembayaran.html";
  }

  function BatalkanPesanan(){
    console.log("Batalkan Pesanan");
  }

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
  }
</script>

<!-- <script type="text/javascript" src="../js/imgSlider.js"></script> -->
</body>
</html>