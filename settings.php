<?php include 'header.php';

?>

<div class="container-fluid">
    <div class ="card">
        <div class="card-header">
            <h3 class="text-primary font-weight-bold">Ayarlar </h3>
        </div>

        <div class="card-body">
            <form action="transactions/process.php" method="POST" accept-charset="utf-8">

                <!-- Başlık-->
                <div class="form-row">
                    <div class="col-md-6">
                        <label>Sitenizin Başlığını Girin</label>
                        <input type="text" class="form-control" name="site_title" value="<?php echo $ayarcek['site_title']?>">
                    </div>
                </div>

                <!-- Açıklama-->
                <div class="form-row my-2">
                    <div class="col-md-6">
                        <label>Sitenizin Açıklamasını Girin</label>
                        <input type="text" class="form-control" name="site_explanation" value="<?php echo $ayarcek['site_explanation']?>">
                    </div>
                </div>

                <!-- Sahip-->
                <div class="form-row">
                    <div class="col-md-6">
                        <label>Site Sahibi</label>
                        <input type="text" class="form-control" name="site_owner" value="<?php echo $ayarcek['site_owner']?>">
                    </div>
                </div>
                <button type ="submit" class="btn btn-primary mt-2" name="ayarlarkaydetme">Kaydet</button>
            </form>
        </div>

    </div>
</div>


<?php include 'footer.php';?>