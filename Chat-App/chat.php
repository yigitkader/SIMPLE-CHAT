<?php 
session_start();
error_reporting(0);
include("ayar.php");

header("Content-type: text/html; charset=iso-8859-9");

$tip=strip_tags($_POST["tip"]);
$mesaj=iconv("UTF-8","ISO-8859-9",strip_tags(trim($_POST["mesaj"])));
$kullanici=$_SESSION["kullaniciAdi"]; 
$rutbe=$_SESSION["rutbe"];
$tarih=date("H:i:s");
echo $mesaj;

switch ($tip) 
{
	//Mesaj Gonderme
	case "gonder":
		//echo 'deneme'; //-->> Deneme Kontrolü
		if (empty($mesaj)) 
		{
			echo 'bos';
		}
		else 
		{
			$ac=fopen("chat.txt","ab");
			$eklenecekler=$tarih."\t".$kullanici."\t".$mesaj."\t".$rutbe."\n";
			$ekle=fwrite($ac,$eklenecekler);	
		}

		break;
	
	//Sohbet Guncelleme   
	case "guncelle":
		$dosya=file("chat.txt");
		//echo var_dump($dosya);
		$toplam=count($dosya);
		if ($toplam>=80) 
		{
			unlink("chat.txt");
			touch("chat.txt");	
		}

		else {
			arsort($dosya);  // Yazdıklarımızı ustte tutmak icin tersten sıralama
			foreach ($dosya as $mesaj) 
			{
				//echo $mesaj."</br>";	
				
				$bol=explode("\t",$mesaj);
				echo "<div class='sohbetMesaji'>
						<strong";
						if ($bol[3]==1) {
							echo " style='background-color:red' ";
						}
				echo ">{$bol[1]}</strong> <span>{$bol[2]}</span>

					 </div>	";


		}
			

		}
		break;	

	// Sohbet Temizleme
	case "temizle":
			
		 break;	

	
}

 ?>