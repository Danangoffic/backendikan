
  <div class="container-fluid">
    <div class="row" style="margin-bottom: -10px">
      <div class="col s12">
        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1">
              <b>STATUS PEMESANAN<span class="secondary-content badge green white-text" style="font-size: 15px; border-radius: 8px;">DIKEMAS</span></b>
            </li>
          </ul>
        </div>
        
        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="secondary-content NoPesanan">310120181025</span></b></li>
            <li class="collection-item teal-text darken-1"><b>Waktu Pemesanan :<span class="secondary-content WaktuPemesanan">31/01/2020 23:00</span></b></li>
            <li class="collection-item teal-text darken-1"><b>Waktu Pembayaran :<span class="secondary-content WaktuPembayaran">31/01/2020 23:30</span></b></li>
          </ul>
        </div>
        
        <div class="card">
          <ul class="collection collection-product"></ul>
        </div>

        <div class="card">
          <ul class="collection">
            <li class="collection-item"><h5>DETAIL PENGIRIMAN</h5></li>
            <li class="collection-item">Alamat Pengiriman :<span class="secondary-content alamat">Jl. Rw Bahagia No. 14</span></li>
            <li class="collection-item">Jenis Pengiriman :<span class="secondary-content tipe-pengiriman">Biasa</span></li>
            <li class="collection-item">Tanggal Pengiriman yang Diajukan :<span class="secondary-content tanggal-pengiriman">02/01/2020</span></li>
            <li class="collection-item teal-text darken-1"><b>Total Biaya Pengiriman :<span class="secondary-content biaya-pengiriman">Rp</span>
              <p class="total-berat" style="margin-top: -5px; margin-bottom: -10px">(xxx ons)</p></b></li>
              <li class="collection-item"><button class="waves-effect waves-light btn blue" type="button" style="width: 100%">Lacak Pengiriman</button></li>
          </ul>
        </div>

        <div class="card">
          <ul class="collection">
            <li class="collection-item"><h5>DETAIL PEMBAYARAN</h5></li>
            <li class="collection-item">Metode Pembayaran :<span class="badge tipe-pembayaran">Bayar Penuh Transfer</span></li>
            <li class="collection-item">Total Harga Produk :<span class="badge total-harga-produk">Rp</span></li>
            <li class="collection-item">Total Biaya Pengiriman :<span class="badge biaya-pengiriman">Rp</span></li>
            <li class="collection-item teal-text darken-1"><b>Total Pembayaran :<span class="badge total-pembayaran">Rp</span></b></li>
          </ul>
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