
<?php 
$host="localhost"; 
$veritabani_ismi="order_tracking"; 
$kullanici_adi="root"; 
$sifre="";

try {
	$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);
	//echo "veritabanı bağlantısı başarılı";
}

catch (PDOExpception $e) {
    echo "veritabanı bağlantısı başarısız";
	echo $e->getMessage();
}

?>
