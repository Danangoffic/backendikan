  <?php
  if($JenisPengiriman=="Cepat" || $JenisPengiriman=="Biasa"){
      if($JenisPembayaran=="Full Transfer"){
        ?>
        <div class="container-fluid">
            <div class="row">
            <div class="col s12">
                <div class="card">
                <ul class="collection">
                    <li class="collection-item teal-text darken-1"><b>STATUS PEMESANAN<span class="secondary-content badge red accent-2 status-pemesanan white-text"  style="font-size: 15px; border-radius: 8px;">BELUM BAYAR</span></b></li>
                </ul>
                </div>

                <div class="card">
                <ul class="collection">
                    <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="secondary-content NoPesanan"></span></b></li>
                    <li class="collection-item teal-text darken-1"><b>Waktu Pemesanan :<span class="secondary-content WaktuPemesanan"></span></b></li>
                </ul>
                </div>

                <div class="card">
                <ul class="collection collection-product">Loading..</ul>
                </div>

                <div class="card">
                <ul class="collection">
                    <li class="collection-item"><h5>DETAIL PENGIRIMAN</h5></li>
                    <li class="collection-item">Alamat Pengiriman :<span class="secondary-content alamat"></span></li>
                    <li class="collection-item">Jenis Pengiriman :<span class="secondary-content tipe-pengiriman"></span></li>
                    <li class="collection-item">Tanggal Pengiriman :<span class="secondary-content tanggal-pengiriman"></span></li>
                    <li class="collection-item teal-text darken-1"><b>Total Biaya Pengiriman :<span class="secondary-content biaya-pengiriman"></span></b><br><span class="total-berat"></span></li>
                </ul>
                </div>

                <div class="card">
                <ul class="collection">
                <li class="collection-item"><h5>DETAIL PEMBAYARAN</h5></li>
                <li class="collection-item">Metode Pembayaran :<span class="secondary-content">Bayar Penuh Transfer</span></li>
                <li class="collection-item">Total Harga Produk :<span class="secondary-content total-harga-produk"></span></li>
                <li class="collection-item">Total Biaya Pengiriman :<span class="secondary-content biaya-pengiriman"></span></li>
                <li class="collection-item teal-text darken-1"><b>Total Pembayaran :<span class="secondary-content total-pembayaran"></span></b></li>
                </ul>
                </div>

                <button class="waves-effect waves-light btn blue" type="button" style="width: 100%" onclick="LanjutkanPembayaran()">Lanjutkan Ke Pembayaran</button>
                <button class="waves-effect waves-light btn red accent-2 modal-trigger" data-target="modal1" type="button" style="width: 100%; margin-top: 8px;">Batalkan Pesanan</button>
                
                <div id="modal1" class="modal large">
                <div class="modal-content">
                    <h5 class="modal-title">Pembatalan Pesanan</h5>
                    <p>Apakah Anda Yakin Ingin Membatalkan Pesanan ini?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-red btn transparent black-text" onclick="BatalkanPesanan()">Ya! Batalkan</a>
                    <a href="#!" class="modal-close waves-effect waves-teal btn teal darken-1">Tidak</a>
                </div>
                </div>

                <div id="modal2" class="modal bottom-sheet">
                <div class="modal-content" style="height: 540px;">
                    <h5 class="center-align">Pembatalan Pemesanan</h5>
                    <div class="center-align" style="margin-top: 128px;">
                    <i class="material-icons teal-text darken-1" style="font-size: 80px;">check_circle</i>
                    </div>
                </div>
                </div>

                <div id="modal3" class="modal bottom-sheet">
                <div class="modal-content" style="height: 540px;">
                    <h5 class="center-align">Pembatalan Pemesanan</h5>
                    <div class="center-align" style="margin-top: 128px;">
                    <i class="material-icons red-text darken-1" style="font-size: 80px;">close</i>
                    </div>
                </div>
                </div>

            </div>
            </div>
        </div>
        <?php
      }else if($JenisPembayaran=="Transfer Cash"){
        ?>
        <div class="container-fluid">
            <div class="row" style="margin-bottom: 8px;">
            <div class="col s12">
                <div class="card">
                <ul class="collection">
                    <li class="collection-item">
                    <b class="teal-text darken-1">STATUS PEMESANAN<span class="secondary-content badge red accent-2 white-text status-pemesanan" style="font-size: 15px; border-radius: 8px;"></span></b>
                    </li>
                </ul>
                </div>
                <div class="card">
                <ul class="collection">
                    <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="secondary-content NoPesanan">310120181025</span></b></li>
                    <li class="collection-item teal-text darken-1"><b>Waktu Pemesanan :<span class="secondary-content WaktuPemesanan">31/01/2020 23:00</span></b></li>
                </ul>
                </div>
                <div class="card">
                <ul class="collection collection-product"></ul>
                </div>
                <div class="card">
                <ul class="collection">
                    <li class="collection-item"><h5>DETAIL PENGIRIMAN</h5></li>
                    <li class="collection-item">Alamat Pengiriman :<span class="secondary-content alamat"></span></li>
                    <li class="collection-item">Jenis Pengiriman :<span class="secondary-content tipe-pengiriman">Biasa</span></li>
                    <li class="collection-item">Tanggal Pengiriman :<span class="secondary-content tanggal-pengiriman">02/01/2020</span></li>
                    <li class="collection-item teal-text darken-1"><b>Total Biaya Pengiriman :<span class="secondary-content biaya-pengiriman">Rp</span></b><br><span class="total-berat"></span></li>
                    <!-- <li class="collection-item" style="">(xxx ons)</p></b> -->
                    <!-- </a> -->
                </ul>
                </div>
                <div class="card">
                <ul class="collection">
                    <li class="collection-item"><h5>DETAIL PEMBAYARAN</h5></li>
                    <li class="collection-item">Metode Pembayaran :<span class="secondary-content">Transfer dan Tunai</span></li>
                    <li class="collection-item">Total Harga Produk :<span class="secondary-content total-harga-produk">Rp</span></li>
                    <li class="collection-item">Total Biaya Pengiriman :<span class="secondary-content biaya-pengiriman">Rp</span></li>
                    <li class="collection-item teal-text darken-1"><b>Total Pembayaran :<span class="secondary-content total-pembayaran">Rp</span></b></li>
                </ul>
                </div>
                <div class="card">
                <ul class="collection">
                    <li class="collection-item teal-text darken-1"><b>Minimal Transfer :<span class="secondary-content">Rp</span></b></li>
                    <li class="collection-item teal-text darken-1"><b>Sisa Tagihan :<span class="secondary-content">Rp</span></b></li>
                </ul>
                </div>
                <button class="waves-effect waves-light btn blue" type="button" style="width: 100%" onclick="LanjutkanPembayaran()">Lanjutkan Ke Pembayaran</button>
                <button class="waves-effect waves-light btn red accent-2 modal-trigger" data-target="modal1" type="button" style="width: 100%; margin-top: 8px;">Batalkan Pesanan</button>
            </div>
            <div id="modal1" class="modal large">
                <div class="modal-content">
                <h5 class="modal-title">Pembatalan Pesanan</h5>
                <p>Apakah Anda Yakin Ingin Membatalkan Pesanan ini?</p>
                </div>
                <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-red btn transparent black-text" onclick="BatalkanPesanan()">Ya! Batalkan</a>
                <a href="#!" class="modal-close waves-effect waves-teal btn green accent-5">Tidak</a>
                </div>
            </div>
            </div>
        </div>
        <?php
      }
  }else if($JenisPengiriman=="Ambil di Toko"){
    if($JenisPembayaran=="Full Transfer"){
      ?>
        <div class="container-fluid">
            <div class="row" style="margin-bottom: 8px">
                <div class="col s12">
                    <div class="card">
                    <ul class="collection">
                        <li class="collection-item teal-text darken-1">
                        <b>STATUS PEMESANAN<span class="secondary-content badge red white-text" style="font-size: 15px; border-radius: 8px;">BELUM DIBAYAR</span></b>
                        </li>
                    </ul>
                    </div>

                    <div class="card">
                    <ul class="collection">
                        <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="secondary-content NoPesanan">310120181025</span></b></li>
                        <li class="collection-item teal-text darken-1"><b>Waktu Pemesanan :<span class="secondary-content WaktuPemesanan">31/01/2020 23:00</span></b></li>
                    </ul>
                    </div>

                    <div class="card">
                    <ul class="collection collection-product"></ul>
                    </div>

                    <div class="card">
                    <ul class="collection">
                        <li class="collection-item"><h5>DETAIL PENGIRIMAN</h5></li>
                        <li class="collection-item">Jenis Pengiriman :<span class="secondary-content">Ambil di Toko</span></li>
                        <li class="collection-item">Tanggal Pengambilan yang Diajukan :<span class="secondary-content tanggal-pengiriman">02/01/2020</span></li>
                    </ul>
                    </div>

                    <div class="card">
                    <ul class="collection">
                        <li class="collection-item"><h5>DETAIL PEMBAYARAN</h5></li>
                        <li class="collection-item">Metode Pembayaran :<span class="secondary-content">Bayar Penuh Transper</span></li>
                        <li class="collection-item teal-text darken-1"><b>Total Harga Produk :<span class="secondary-content total-harga-produk">Rp</span></b></li>
                        <li class="collection-item teal-text darken-1"><b>Total Pembayaran :<span class="secondary-content total-pembayaran">Rp</span></b></li>
                    </ul>
                    </div>
                    <button class="waves-effect waves-light btn blue" type="button" style="width: 100%" onclick="LanjutkanPembayaran()">Lanjutkan Ke Pembayaran</button>
                    <button class="waves-effect waves-light btn red accent-2 modal-trigger" data-target="modal1" type="button" style="width: 100%; margin-top: 8px;">Batalkan Pesanan</button>

                </div>
            </div>
        </div>
      <?php
    }else if($JenisPembayaran=="Full Cash"){
      ?>
      <div class="container-fluid">
        <div class="row" style="margin-bottom: 0px">
            <div class="col s12">
                <div class="card">
                <ul class="collection">
                    <li class="collection-item teal-text darken-1"><b>STATUS PEMESANAN<span class="secondary-content badge red accent-2 status-pemesanan white-text"  style="font-size: 15px; border-radius: 8px;"></span></b></li>
                </ul>
                </div>

                <div class="card">
                <ul class="collection">
                    <li class="collection-item teal-text darken-1"><b>No. Pesanan :<span class="secondary-content NoPesanan">310120181025</span></b></li>
                    <li class="collection-item teal-text darken-1"><b>Waktu Pemesanan :<span class="secondary-content WaktuPemesanan">31/01/2020 23:00</span></b></li>
                </ul>
                </div>

                <div class="card">
                <ul class="collection collection-product"></ul>
                </div>

                <div class="card">
                <ul class="collection">
                    <li class="collection-item"><h5>DETAIL PENGIRIMAN</h5></li>
                    <li class="collection-item">Jenis Pengiriman :<span class="secondary-content tipe-pengiriman">Ambil di Toko</span></li>
                    <li class="collection-item">Tanggal Pengambilan :<span class="secondary-content tanggal-pengiriman">02/01/2020</span></li>
                </ul>
                </div>

                <div class="card">
                <ul class="collection">
                    <li class="collection-item"><h5>DETAIL PEMBAYARAN</h5></li>
                    <li class="collection-item">Metode Pembayaran :<span class="secondary-content">Bayar Penuh Tunai</span></li>
                    <li class="collection-item">Total Harga Produk :<span class="secondary-content total-harga-produk">Rp</span></li>
                    <li class="collection-item teal-text darken-1"><b>Total Pembayaran :<span class="secondary-content total-pembayaran">Rp</span></b></li>
                </ul>
                </div>

            <div class="card">
            <div class="card-content red darken-1 white-text">
                <p class="flow-text center">Silahkan ambil produk sesuai <br><b><a class="waves-effect waves-light modal-trigger white-text" href="#modal1">TANGGAL PENGAMBILAN</a></b> <br>dan melakukan pembayaran sebesar <br><b><a class="waves-effect waves-light modal-trigger white-text" href="#modal2">TOTAL PEMBAYARAN</a></b><br> secara langsung ke <b>PENJUAL</b></p>
            </div>
            </div>

            <!-- Modal Structure -->
            <div id="modal1" class="modal bottom-sheet">
            <div class="modal-content">
                <h6 class="modal-title center-align">Tanggal Pengambilan:</h6>
                <h5 class="tanggal-pengiriman center-align red-text"></h5>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-light btn red accent-2">Tutup</a>
            </div>
            </div>
            <div id="modal2" class="modal bottom-sheet">
            <div class="modal-content">
                <h6 class="modal-title center-align">Total Pembayaran:</h6>
                <h5 class="total-pembayaran center-align red-text"></h5>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-light btn red accent-2">Tutup</a>
            </div>
            </div>
        </div>
      <?php
    }else if($JenisPembayaran=="Transfer Cash"){
      ?>
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
      <?php
    }
  }
  ?>
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