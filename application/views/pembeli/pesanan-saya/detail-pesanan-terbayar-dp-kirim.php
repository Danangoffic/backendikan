<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

  <!-- Twitter -->
  <meta name="twitter:site" content="@themepixels">
  <meta name="twitter:creator" content="@themepixels">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Bracket">
  <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

  <!-- Facebook -->
  <meta property="og:url" content="http://themepixels.me/bracket">
  <meta property="og:title" content="Bracket">
  <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

  <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="600">

  <!-- Meta -->
  <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="author" content="ThemePixels">

  <title>Detail Pesanan</title>

  <!-- vendor css -->
  <link href="../../materialize-css/dist/css/materialize.css" rel="stylesheet" media="screen,projection">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link href="../../assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
  <link href="../../assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
</head>

<body class="">
  <header>
    <nav class="top-nav" style="background-image: linear-gradient(to right, #00b7f8, #009dff, #0080ff, #005dff, #0029ee);">
      <div class="container-fluid">
        <div class="nav-wrapper">
          <div class="row">
            <div class="col s12 m10 offset-m1">
              <a id="#" href="profil.html" onclick="return onBackKeyDown()" class="transparent" style="margin: auto 10px;"><span class="fa fa-chevron-left"></span></a>
              <b class="header">&nbsp;Detail Pesanan</b>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <div class="container-fluid">
    <div class="row" style="margin-bottom: 0px">
      <div class="col s12">
        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1">
              <b>STATUS PEMESANAN<span class="secondary-content badge green status-pemesanan white-text" style="font-size: 15px; border-radius: 8px;">DIKEMAS</span></b>
            </li>
          </ul>
        </div>

        <div class="card">
          <ul class="collection">
            <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="secondary-content NoPesanan">310120181025</span></b></li>
            <li class="collection-item">Waktu Pemesanan :<span class="secondary-content WaktuPemesanan">31/01/2020 23:00</span></li>
            <li class="collection-item">Waktu Pembayaran :<span class="secondary-content WaktuPembayaran">31/01/2020 23:00</span></li>
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
            <li class="collection-item"><b>Total Biaya Pengiriman :<span class="secondary-content biaya-pengiriman">Rp</span>
              <p class="total-berat" style="margin-top: 0px;">(xxx ons)</p></b></li>
          </ul>
        </div>

        <div class="card">
          <ul class="collection">
            <li class="collection-item"><h5>DETAIL PEMBAYARAN</h5></li>
            <li class="collection-item">Metode Pembayaran :<span class="secondary-content">Transfer dan Tunai</span></li>
            <li class="collection-item">Total Harga Produk :<span class="secondary-content total-harga-produk">Rp</span></li>
            <li class="collection-item">Total Biaya Pengiriman :<span class="secondary-content biaya-pengiriman">Rp</span></li>
            <li class="collection-item"><b>Total Pembayaran :<span class="secondary-content total-pembayaran">Rp</span></b></li>
            <li class="collection-item"><b>Minimal Transfer :<span class="secondary-content minimal-transfer">Rp</span></b></li>
            <li class="collection-item"><b>Sisa Tagihan :<span class="secondary-content sisa-tagihan">Rp</span></b></li>
          </ul>
        </div>
        <div class="card">
          <div class="collection red darken-1 white-text">
            <p class="flow-text center-align">
              Silahkan melakukan pembayaran sebesar<br><b><a class="waves-effect waves-light modal-trigger white-text" href="#modal2">SISA TAGIHAN</a></b><br>
              secara langsung ke 
              <b>KURIR</b></p>
          </div>
        </div>

        <div id="modal2" class="modal bottom-sheet">
          <div class="modal-content">
            <h6 class="modal-title center-align">Sisa Tagihan:</h6>
            <h5 class="total-pembayaran center-align red-text"></h5>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light btn red accent-2">Tutup</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- ########## END: MAIN PANEL ########## -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<!-- <script type="text/javascript" src="../materialize-css/dist/js/materialize.js"></script> -->
<!-- <script src="../assets/lib/popper.js/popper.js"></script> -->
<!-- <script src="../assets/lib/bootstrap/bootstrap.js"></script> -->
<script src="../../assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="../../assets/lib/moment/moment.js"></script>
<script src="../../assets/lib/jquery-ui/jquery-ui.js"></script>
<script src="../../assets/lib/jquery-switchbutton/jquery.switchButton.js"></script>
<script src="../../assets/lib/peity/jquery.peity.js"></script>
<!-- <script src="../assets/lib/codemirror/addon/scroll/simplescrollbars.js"></script> -->

<!-- <script src="../assets/js/bracket.js"></script> -->
<script type="text/javascript" src="../../materialize-css/dist/js/materialize.js"></script>


<script type="text/javascript" src="../../js/mobile_script.js"></script>
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
    HtmlProduk = '<li class="collection-item"><a href="#!"><h6 class="nama-toko"></h6></a></li>'+
                  '<li class="collection-item"><h5>DAFTAR PRODUK</h5></li>';
    $.each(AllPurchaseProduk, function(i,isi){
      var FotoProduk = base_url+ '/foto_usaha/produk/' + isi.foto_produk;
      var NamaProduk = isi.nama_produk + ' ' + isi.nama_variasi;
      var HargaProduk = isi.harga;
      var TotalProduk = isi.jml_produk;
      HtmlProduk += '<li class="collection-item avatar"><img src="'+FotoProduk+'" alt="" class="circle">'+
              '<span class="title">'+NamaProduk+'</span>'+
              '<p class="orange-text">Rp '+HargaProduk+'<br></p>'+
              '<span class="secondary-content">'+TotalProduk+'&times;</span></li>';
    });
    HtmlProduk +='<li class="collection-item teal-text darken-1"><b >Total Harga Produk :<span class="secondary-content total-harga-produk">Rp</span></b></li>';
    $(".collection-product").html(HtmlProduk);
    $(".nama-toko").html("<a href='#!' onclick='GoToDetailUsaha("+IdUsaha+")'>"+nama_usaha+"</a>");
    $(".alamat").html(Alamat);
    $(".tipe-pengiriman").html(JenisPengiriman);
    $(".tanggal-pengiriman").html(TanggalPengiriman);
    $(".total-berat").html(TotalBeratProduk+"&nbsp;Ons");
    $(".biaya-pengiriman").html("Rp " + BiayaPengiriman);
    $(".tipe-pembayaran").html(metode_pembayaran);
    $(".total-harga-produk").html("Rp&nbsp;" + TotalHargaProduk);
    $(".total-pembayaran").html("Rp&nbsp;" + TotalHargaAll);
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