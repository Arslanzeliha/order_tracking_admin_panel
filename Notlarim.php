<?php

//Veri Çekme 
$ayarsor=$db->prepare("SELECT * FROM settings");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);


//Veri Güncelleme 
if(isset($_POST['ayarlarkaydetme'])){
    $ayarkaydet=$db->prepare("UPDATE settings SET 
        site_title=:site_title , 
        site_explanation=:site_explanation, 
        site_owner=:site_owner");

    $ayarkaydet->execute(array(
        'site_title'=> $_POST['site_title'],
        'site_explanation'=>$_POST['site_explanation'],
        'site_owner'=>$_POST['site_owner']
        //Güvenlik açığından dolayı 
    ));
}
?>

