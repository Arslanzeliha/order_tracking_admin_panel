<?php include 'header.php'; 

if(isset($_POST['sip_id'])){
$siparissor=$db->prepare("SELECT * FROM siparis WHERE sip_id=:id");
$siparissor->execute(array(
    'id'=>$_POST['sip_id']
));

$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);
}else{
    header("location:index.php");
}

?>

<div class="container">
<div class="card">
    <div class="card-header">
        <h3 class="display-4" style="font-size:2rem">Sipariş Düzenle </h3>
    </div>
    <div class="card-body">
        <form action="transactions/process.php" method="POST">

        <div class="form-row mt-2">

            <div class="col-md-6">
            <label>İsim Soyisim</label>
            <input type="text" name="musteri_isim" class="form-control" value="<?php echo $sipariscek['musteri_isim']; ?>">
            </div>
            <div class="col-md-6">
            <label>Mail Adresi</label>
            <input type="email" name="musteri_mail" class="form-control"  value="<?php echo $sipariscek['musteri_mail']; ?>">
            </div>

            </div>

            <div class="form-row mt-2">                  
            <div class="col-md-6">
            <label>Telefon No </label>
            <input type="number" name="musteri_telefon" class="form-control" value="<?php echo $sipariscek['musteri_telefon']; ?>">
            </div>
            <div class="col-md-6">
            <label>Sipariş Başlığı</label>
            <input type="text" name="sip_baslik" class="form-control" value="<?php echo $sipariscek['sip_baslik']; ?>">
            </div>            
            </div>

            <div class="form-row mt-2">
            <div class="form-group col-md-6">
            <label>Sipariş Durumu </label>
            <select required name="sip_durum" class="form-control">
                            <option <?php if ($sipariscek['sip_durum'] == "Başlanmadı") { echo "selected"; } ?> value="Başlanmadı">Başlanmadı</option>
                            <option <?php if ($sipariscek['sip_durum'] == "Devam Ediyor") { echo "selected"; } ?> value="Devam Ediyor">Devam Ediyor</option>
                            <option <?php if ($sipariscek['sip_durum'] == "Bitti") { echo "selected"; } ?> value="Bitti">Bitti</option>
                        </select>

            </div>
            <div class="form-group col-md-6">
            <label>Ücret (TL) </label>
            <input type="number" required name="sip_ucret" class="form-control" value="<?php echo $sipariscek['sip_ucret']; ?>">
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-6">
            <label>Sipariş Teslim Tarihi</label>
            <input type="date" required name="sip_teslim_tarihi" class="form-control" value="<?php echo $sipariscek['sip_teslim_tarihi']; ?>" >
            </div>
            <div class="form-group col-md-6">
            <label>Sipariş Aciliyeti</label>
            <select required required name="sip_aciliyet" class="form-control">
                            <option <?php if ($sipariscek['sip_aciliyet'] == "Acil") { echo "selected"; } ?> value="Acil">Acil</option>
                            <option <?php if ($sipariscek['sip_aciliyet'] == "Acelesi Yok") { echo "selected"; } ?> value="Acelesi Yok">Acelesi Yok</option>
                            <option <?php if ($sipariscek['sip_aciliyet'] == "Normal") { echo "selected"; } ?> value="Normal">Normal</option>
                        </select>
            </div>
            </div>
            <input type="hidden" name="sip_id" value="<?php echo $_POST['sip_id'] ?>">
            <div class="form-row mt-2">
            <div class="form-group col-md-12">
            <label>Sipariş Detayı</label>
            <textarea required name="sip_detay" class="form-control" id="editor"> <?php echo $sipariscek['sip_detay']; ?></textarea>
            </div></div>

            <button name="siparisduzenleme" type="submit" class="btn btn-primary mt-2">Kaydet</button>

        </form>
    </div>
</div>
</div>



<?php include 'footer.php'; ?>
