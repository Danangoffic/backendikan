
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
<script type="text/javascript">
  $('.modal').modal();
  $("#modal2").modal();
  $("#modal3").modal();
  var modal3 = $("#modal3");
  var modal2 = $("#modal2");
  var option2 = {onCloseEnd: onCloseSuccess};
  var modal1 = $("#modal1");
  var instance3 = M.Modal.getInstance(modal3);
  var instance2 = M.Modal.getInstance(modal2, option2);
  var instance1 = M.Modal.getInstance(modal1);
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
    // $(".status-pemesanan").html(StatusPemesanan);
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
              '<p class="orange-text">Rp '+formatNumber(HargaProduk)+'<br></p>'+
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
    var idPesanan = DetailPesanan.idPemesanan;
    var data = {"idPesanan" : idPesanan};
    console.log(data);
    $.ajax({
      url: base_url + "Pemesanan/HapusPemesananByIdPemesanan",
      data: data,
      type: "POST",
      dataType: "JSON",
      success: function(result){
        if(result.responseMessage=="success"){
          instance2.open();
          setTimeout(function(){ window.location.href="pesanan-saya.html" }, 3000);
        }else{
          instance3.open();
        }
      }
    })
    
  }

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
  }

  function onCloseSuccess() {
    
  }
</script>