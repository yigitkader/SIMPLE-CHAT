<?php session_start(); ?>
<?php include("ayar.php"); ?>
<?php include("fonksiyonlar.php") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sohbet</title>
	<meta http-equiv="Content-Type" content="text/html" charset="ISO-SS59-9"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript">
		
		
		document.onkeydown=mesajGonder;
		
		function mesajGonder(x)
		{
			var tus;
			tus=x.which;
			if (tus==13) 
			{
				//alert("Entera bastınız");
				var mesaj=$("textarea[name=mesaj]").val();
				
				$("textarea[name=mesaj]").attr("disabled","disabled");
				
				
				$.ajax(
					{
						type: "POST",
						url: "chat.php",
						data: {"tip":"gonder","mesaj":mesaj},
						success: function(sonuc)
						{
							//alert(sonuc);  --> Kontrol
							
							if (sonuc=="bos")
							{
								alert("Lütfen boş mesaj gondermeyin");
								$("textarea[name=mesaj]").removeAttr("disabled"); 
								

							}
							else
							{
									$("textarea[name=mesaj]").removeAttr("disabled"); 
									$("textarea[name=mesaj]").val("");
									sohbetGuncelle();
									//alert(sonuc);
									$("#area").focus();
							} 
						

						}
					});
				
					
			}
		}

		function sohbetGuncelle()
		{
			$.ajax({
				type:"POST",
				url:"chat.php",
				data:{"tip":"guncelle"},
				success: function(sonuc)
				{
					$("#sohbet-icerik").html(sonuc);
				}
			})
		}
		sohbetGuncelle();
		setInterval("sohbetGuncelle()",1500);
	</script>

</head>
<body>

<?php if ($_SESSION["oturum"]) { ?>
		<div style="margin-left:95%;">
			<a style=" color: red;" href="out.php">Çıkış Yap</a>
		</div>
	<?php } ?>

<?php 
	if ($_SESSION["oturum"]) { ?>
		
	
<div id="sohbet-genel">
	<div id="sohbet-icerik" >	
	</div>

	<div id="mesaj-gonder">
		
			<h3>Mesaj Gonder</h3><textarea id="area" rows="0" cols="0" name="mesaj"></textarea>
		
		
		
			
		
	</div>
	

</div>
<?php } 

 else 
 { 
 	if ($_POST) 
 	{

 		$kullaniciAdi=post("kullaniciAdi");
 		$pass=md5(post("parola"));

 		echo '<div id="giris">';
 		$sorgu="SELECT * FROM UYELER WHERE KULLANICI_ADI=:kadi AND PAROLA=:pass";
 		$stmt=$db->prepare($sorgu);
 		$stmt->execute(array('kadi'=>$kullaniciAdi,'pass'=>$pass));
 		$row=$stmt->fetch();
 		if ($stmt->rowCount()==1) 
 		{
	 		$_SESSION["oturum"]=true;
	 		$_SESSION["kullaniciAdi"]=$kullaniciAdi;	
	 		$_SESSION["rutbe"]=$row["RUTBE"]; 			
	 		//header("Location:index.php");
	 		echo '<meta http-equiv="refresh" content="0.00000000000001;url=/SohbetUygulamasi/index.php" />' ;
 		}
 		else 
 		{
 			echo '<font color="red">Giris Başarısız';
 			echo '<meta http-equiv="refresh" content="1;url=/SohbetUygulamasi/index.php" />' ;
 			//header("Location:index.php");
 		}
 		echo '</div>';
 	
 	}
 	else {
 
	?>
	 <div id="giris">
	 		<span style="text-align: center; color: red;">Uye değilseniz ilk olarak üye olunuz</span><br>
			<form action="" method="post">
				<span>Kullanıcı Adı</span>
				<span><input type="text" class="giris_in" required="required=" autofocus name="kullaniciAdi"></span>
				<span>Sifre</span>
				<span><input type="password" required="required=" class="giris_in" name="parola"></span>
				<span style="float: left;"><input type="submit"  value="Giris Yap" name=""> &nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  formaction="uye-ol.php" value="Uye Ol" name=""></span>

				 
			</form>
	</div>	
	<?php } } ?>

	




</body>
</html>