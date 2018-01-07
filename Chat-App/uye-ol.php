
<?php 
include("fonksiyonlar.php");
include("ayar.php");

$kullaniciAdi=post("kullaniciAdi");
$password=md5(post("parola"));

if (!isset($kullaniciAdi) || !isset($password) || empty($kullaniciAdi) || empty($password)) 
{	
	echo '<font color="red">Verilerinizde eksiklikler var,anasayfaya yönlendiriliyorsunuz';
 	echo '<meta http-equiv="refresh" content="1;url=/SohbetUygulamasi/index.php" />' ;
	
}
else {
	$query="SELECT * FROM UYELER WHERE KULLANICI_ADI=:ad";
	$stmt=$db->prepare($query);
	$stmt->execute(array('ad'=>$kullaniciAdi));

	if ($stmt->rowCount()>0) 
	{
			echo '<font color="red">Böyle bir kullanici adi vardır, baska bir ad deneyeniz';
 			echo '<meta http-equiv="refresh" content="1;url=/SohbetUygulamasi/index.php" />' ;
	}
	else {
		$durum=1; //chat durumu  mesela sitenen bloklanan engellenen kullanıcılar icin bir durum
		$rutbe=0;  // Normal kullanıcıların yetkisi 0 dır. Adminin 1 ' dir;
		$query2="INSERT INTO UYELER(KULLANICI_ADI,PAROLA,RUTBE,CHAT_DURUMU) VALUES(:kadi,:pass,:rutbe,:durum)";
		$stmt2=$db->prepare($query2);
		$stmt2->execute(array(
			'kadi'=>$kullaniciAdi,
			'pass'=>$password,
			'rutbe'=>$rutbe,
			'durum'=>$durum));


		if ($stmt2) 
		{
				echo '<font color="red"> Kaydınız tamamlanmıştır, anasayfaya yönlendiriliyorsunuz';
 			echo '<meta http-equiv="refresh" content="1;url=/SohbetUygulamasi/index.php" />' ;	
		}
	}

}









 ?>