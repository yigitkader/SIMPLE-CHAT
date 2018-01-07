<?php session_start(); ?>
<?php include("ayar.php"); ?>
<?php include("fonksiyonlar.php") ?>
<?php 


 		$kullaniciAdi=post("kullaniciAdi"); 
 		$pass=post("parola");

 		
 		$sorgu="SELECT * FROM WHERE KULLANICI_ADI=:kadi AND PAROLA=:pass";
 		$stmt=$db->prepare($sorgu);
 		$stmt->execute(array('kadi'=>$kullaniciAdi,'pass'=>$pass));
 		$row=$stmt->fetch();
 		
 		if ($stmt->rowCount()==1) 
 		{
			
			
	 		$_SESSION["giris"]=1;
	 		
	 		$_SESSION["kullaniciAdi"]=$kullaniciAdi;	
	 		$_SESSION["rutbe"]=row["rutbe"]; 
	 		if ($_SESSION["rutbe"]==1) 
	 		{
	 			$_SESSION["giris"]=1;
				$_SESSION["admin"]=1;
				echo("<center><b> Admin sayfasına  yönlendiriliyorsunuz..</center>");
				echo '<meta http-equiv="refresh" content="3;url=/ygt/index.php" />' ; 
	 		}
	 		else 
	 		{
	 			$_SESSION["admin"]=0;
				$_SESSION["giris"]=1; 				
				echo("<center><b> Admin sayfasına  yönlendiriliyorsunuz..</center>");
				echo '<meta http-equiv="refresh" content="3;url=/ygt/index.php" />' ; 
	 		}			
	 		//header("Location:index.php");
	 		//echo '<meta http-equiv="refresh" content="3;url=/SohbetUygulamasi/index.php" />' ;
 		}
 		else 
 		{
 			echo '<font color="red">Giris Başarısız';
 			echo '<meta http-equiv="refresh" content="3;url=/SohbetUygulamasi/index.php" />' ;
 			//header("Location:index.php");
 		}
 		echo '</div>';
 	
 	}
 	else {
 