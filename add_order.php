<?php include 'header.php' ?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class ="card-title">Sipariş Ekle </h5>
            
        </form>
    </div>
    
        <div class="card-body">
            <form action="transactions/process.php" method="POST">

                <div class="form-row mt-2">

                    <div class="col-md-6">
                    <label>İsim Soyisim</label>
                    <input type="text" name="musteri_isim" class="form-control" placeholder="Müşterinizin İsmini girin">
                    </div>
                    <div class="col-md-6">
                    <label>Mail Adresi</label>
                    <input type="email" name="musteri_mail" class="form-control" placeholder="Müşterinizin Mailini girin">
                    </div>
                    
                </div>

                <div class="form-row mt-2">                  
                    <div class="col-md-6">
                    <label>Telefon No </label>
                    <input type="number" name="musteri_telefon" class="form-control" placeholder="Müşterinizin Telefon Numarasını girin">
                    </div>
                    <div class="col-md-6">
                    <label>Sipariş Başlığı</label>
                    <input type="text" name="sip_baslik" class="form-control" placeholder="Siparişinizin Başlığını girin">
                    </div>            
                </div>

                <div class="form-row mt-2">
                    <div class="form-group col-md-6">
                    <label>Sipariş Durumu </label>
                    <select required name="sip_durum" class="form-control" >
                            <option value="Başlanmadı">Başlanmadı</option>
                            <option value="Devam Ediyor">Devam Ediyor</option>
                            <option value="Bitti">Bitti</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label>Ücret (TL) </label>
                    <input type="number" required name="sip_ucret" class="form-control" placeholder="Sipariş Ücretini Girin">
                    </div>
                </div>
                
                <div class="form-row">
                <div class="form-group col-md-6">
                        <label>Sipariş Teslim Tarihi</label>
                        <input type="date" required name="sip_teslim_tarihi" class="form-control" placeholder="Siparişin Teslim Tarihini Girin" >
                    </div>
                    <div class="form-group col-md-6">
                    <label>Sipariş Aciliyeti</label>
                        <select required required name="sip_aciliyet" class="form-control" >
                            <option value="Acil">Acil</option>
                            <option value="Acelesi Yok">Acelesi Yok</option>
                            <option value="Normal">Normal</option>
                        </select>
                    </div>
                </div>
<!--
                <div class="form-row ">
                    <div class="col-md-6">
                    <div class="file-loading">
                        <input class="form-control" id="siparis_dosya" name="siparis_dosya" type="file">
                    </div>
                    </div>
                </div>
-->
                <div class="form-row mt-2">
                <div class="form-group col-md-12">
                    <label>Sipariş Detayı</label>
                    <textarea required name="sip_detay" class="form-control" id="editor"></textarea>
                </div></div>

                <button name="siparisekle" type="submit" class="btn btn-primary mt-2">Kaydet</button>
            </form>
        
        </div>

    </div>

</div>

<?php include 'footer.php'?>
<script>
  $(document).ready(function () {
    
    $("#siparis_dosya").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
      allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
    });
  });
</script>