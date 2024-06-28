<?php
include 'connect.php';

ob_start();
session_start();


function tr_degistirme($metin) {
	$turkce=array("ş","Ş","ı","ü","Ü","ö","Ö","ç","Ç","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü");
	$duzgun=array("s","S","i","u","U","o","O","c","C","s","S","i","g","G","I","o","O","C","c","u","U");
	$metin=str_replace($turkce,$duzgun,$metin);
	$metin = preg_replace("@[^a-z0-9\-_şıüğçİŞĞÜÇ]+@i","-",$metin);
	$yeniisim = mb_strtolower($metin, 'utf8');
	return $yeniisim;
};

 //Site Bilgileri Güncelleme
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

 //Oturum Açma
if(isset($_POST['oturumac'])){
    $kullanicisor=$db->prepare("SELECT * FROM user WHERE 
        user_mail=:mail AND 
        user_password=:sifre");
    $kullanicisor->execute(array(
        'mail'=>$_POST['user_mail'],
        'sifre'=>$_POST['user_password']
    ));
    $sonuc=$kullanicisor->rowcount();
    if($sonuc==0){
        echo "Mail ya da şifre hatalı";
    }else{
        header("location:index.php");
        $_SESSION['user_mail']=$_POST['user_mail'];
    }
}
/************************************************************************************************** 
PROJE İŞLEMLERİ * */

//Proje Ekleme
if(isset($_POST['projeekle'])){
    $projeekle=$db->prepare("INSERT INTO proje SET
        proje_baslik=:baslik,
        proje_teslim_tarihi=:teslim_tarihi,
        proje_aciliyet=:aciliyet,
        proje_durum=:durum,
        proje_detay=:detay");

    $projeekle->execute(array(
        'baslik'=>$_POST['proje_baslik'],
        'teslim_tarihi'=>$_POST['proje_teslim_tarihi'],
        'aciliyet'=>$_POST['proje_aciliyet'],
        'durum'=>$_POST['proje_durum'],
        'detay'=>$_POST['proje_detay']));

    $gecici_isim=$_FILES['proje_dosya']['tmp_name'];
    $dosya_ismi=tr_degistirme($_FILES['proje_dosya']['name']);
    move_uploaded_file($gecici_isim, "../dosyalar/$dosya_ismi");

    if($projeekle){
        echo "<script type='text/javascript'>
        alert('Proje başarıyla eklendi.');
        window.location.href = '../projects.php';
    </script>";
    //exit();
    }else{
        echo "<script type='text/javascript'>
        alert('Proje eklenemedi.');
        exit();
    </script>";
    }
}






//Proje Düzenle
if(isset($_POST['projeduzenle'])){
    $projeduzenle=$db->prepare("UPDATE proje SET
        proje_baslik=:baslik,
        proje_teslim_tarihi=:teslim_tarihi,
        proje_aciliyet=:aciliyet,
        proje_durum=:durum,
        proje_detay=:detay WHERE proje_id=:proje_id
        
        ");

    $projeduzenle->execute(array(
        'baslik'=>$_POST['proje_baslik'],
        'teslim_tarihi'=>$_POST['proje_teslim_tarihi'],
        'aciliyet'=>$_POST['proje_aciliyet'],
        'durum'=>$_POST['proje_durum'],
        'detay'=>$_POST['proje_detay'],
        'proje_id'=>$_POST['proje_id']
    ));

    if($projeduzenle){
        echo "<script type='text/javascript'>
        alert('Proje başarıyla güncellendi.');
        window.location.href = '../projects.php';
    </script>";
    //exit();
    }else{
        echo "<script type='text/javascript'>
        alert('Proje güncellenemedi.');
        exit();
    </script>";
    }
}

//Proje Silme
if(isset($_POST['projesilme'])){
    $sil=$db->prepare("DELETE FROM proje WHERE proje_id=:proje_id");
    $kontrol=$sil->execute(array(
        'proje_id'=>$_POST['proje_id']

    ));
    if($kontrol){
        echo "<script type='text/javascript'>
        alert('Proje başarıyla silindi.');
        window.location.href = '../projects.php';
    </script>";
    //exit();
    }else{
        echo "<script type='text/javascript'>
        alert('Proje silinemedi.');
        exit();
    </script>";
    }

}
/************************************************************************************************** 
SİPARİŞ İŞLEMLERİ * 
sip_id	musteri_isim	musteri_mail	musteri_telefon	sip_baslik	sip_durum	sip_ucret	sip_teslim_tarihi	sip_aciliyet	sip_detay	

*/
//Sipariş Ekleme

if(isset($_POST['siparisekle'])){
    $siparisekle=$db->prepare("INSERT INTO siparis SET
        musteri_isim=:musteri_isim,
        musteri_mail=:musteri_mail,
        musteri_telefon=:musteri_telefon,
        sip_baslik=:sip_baslik,
        sip_durum=:sip_durum,
        sip_ucret=:sip_ucret,
        sip_teslim_tarihi=:sip_teslim_tarihi,
        sip_aciliyet=:sip_aciliyet,
        sip_detay=:sip_detay"
        );

    $siparisekle->execute(array(
        'musteri_isim'=>$_POST['musteri_isim'],
        'musteri_mail'=>$_POST['musteri_mail'],
        'musteri_telefon'=>$_POST['musteri_telefon'],
        'sip_baslik'=>$_POST['sip_baslik'],
        'sip_durum'=>$_POST['sip_durum'],
        'sip_ucret'=>$_POST['sip_ucret'],
        'sip_teslim_tarihi'=>$_POST['sip_teslim_tarihi'],
        'sip_aciliyet'=>$_POST['sip_aciliyet'],
        'sip_detay'=>$_POST['sip_detay']
    ));

    $gecici_isim=$_FILES['siparis_dosya']['tmp_name'];
    $dosya_ismi=tr_degistirme($_FILES['siparis_dosya']['name']);
    move_uploaded_file($gecici_isim,"../dosyalar/$dosya_ismi");

    if($siparisekle){
        echo "<script type='text/javascript'>
        alert('Siparis başarıyla eklendi.');
        window.location.href = '../orders.php';
    </script>";
    //exit();
    }else{
        echo "<script type='text/javascript'>
        alert('Siparis eklenemedi.');
        exit();
    </script>";
    }
}
    

//Sipariş Düzenle 
if(isset($_POST['siparisduzenleme'])){
    $siparisduzenleme=$db->prepare("UPDATE siparis SET
        musteri_isim=:musteri_isim,
        musteri_mail=:musteri_mail,
        musteri_telefon=:musteri_telefon,
        sip_baslik=:sip_baslik,
        sip_durum=:sip_durum,
        sip_ucret=:sip_ucret,
        sip_teslim_tarihi=:sip_teslim_tarihi,
        sip_aciliyet=:sip_aciliyet,
        sip_detay=:sip_detay WHERE sip_id=:id
        
        ");

    $siparisduzenleme->execute(array(
        'musteri_isim'=>$_POST['musteri_isim'],
        'musteri_mail'=>$_POST['musteri_mail'],
        'musteri_telefon'=>$_POST['musteri_telefon'],
        'sip_baslik'=>$_POST['sip_baslik'],
        'sip_durum'=>$_POST['sip_durum'],
        'sip_ucret'=>$_POST['sip_ucret'],
        'sip_teslim_tarihi'=>$_POST['sip_teslim_tarihi'],
        'sip_aciliyet'=>$_POST['sip_aciliyet'],
        'sip_detay'=>$_POST['sip_detay'],
        'id'=>$_POST['sip_id']
    ));

    if($siparisduzenleme){
        echo "<script type='text/javascript'>
        alert('Sipariş başarıyla güncellendi.');
        window.location.href = '../orders.php';
    </script>";
    //exit();
    }else{
        echo "<script type='text/javascript'>
        alert('Sipariş güncellenemedi.');
        exit();
    </script>";
    }
}

//Sipariş Silme
if(isset($_POST['siparissilme'])){
    $sil=$db->prepare("DELETE FROM siparis WHERE sip_id=:sip_id");
    $kontrol=$sil->execute(array(
        'sip_id'=>$_POST['sip_id']

    ));
    if($kontrol){
        echo "<script type='text/javascript'>
        alert('Sipariş başarıyla silindi.');
        window.location.href = '../orders.php';
    </script>";
    //exit();
    }else{
        echo "<script type='text/javascript'>
        alert('Sipariş silinemedi.');
        exit();
    </script>";
    }

}
    

?>