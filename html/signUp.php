<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <style>
	  	.formulir{
	  		margin-left: 20%;
	  	}
	  	@media screen and (max-width: 800px) {
		  .formulir{
		    margin-left: -4%; /* The width is 100%, when the viewport is 800px or smaller */
		  }
		}
	  </style>
</head>

<body class="#ffcc80 orange lighten-3">

	<nav style="background-color: #FFA826;height: 72px;">
    <div class="nav-wrapper">
      <a href="../index.php" class="brand-logo"><img src="../img/exLogo.png" style="max-height: 50px;max-width: 50px;margin: 7px;margin-left: 14px;"></a>
      <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
	    <li><a href="../index.php">Home</a></li>
	    <li><a href="kategori.html">Kategori</a></li>
	    <li><a href="About.html">About Us</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">Javascript</a></li>
    <li><a href="mobile.html">Mobile</a></li>
  </ul>

	<div class="row formulir">
		<button class="waves-effect waves-light btn col s4" style=" height: 84px;margin: 40px;padding: 5px;" onclick="pembeli()">Daftar sebagai pembeli</button>
		<button class="waves-effect waves-light btn col s4" style=" height: 84px;margin: 40px;padding: 5px;" onclick="penjual()">Daftar sebagai penjual</button>
	</div>

	<div id="pembeli" style="float: left;display: none;">
		<form class="formulir" method="POST" name="form-pembeli" action="" onsubmit="isemptyPembeli()" >
			<div class="container row #fff8e1 amber lighten-5" style="color: black;padding: 40px;border-radius: 30px;">

				<p class="col s4">Nama - lengkap:</p>	 <input class="col s8" type="text" name="nama">
				<p class="col s4">Email :</p>			 <input class="col s8" type="text" name="email">
				<p class="col s4">Password :</p>		 <input onkeyup='checkPembeli();'class="col s8" type="password" id="PembelipassId" name="pass">
				<p class="col s4">Repeat - Password :</p><input onkeyup='checkPembeli();'class="col s8" type="password" id="PembelirPassId"name="rPass">

				<button name="submitPembeli" id="submitPembeli" class="btn waves-effect waves-light disabled" type="submit" style="margin-top: 20px;">Submit
			    	<i class="material-icons right">send</i>
				</button>
			</div>
		</form>

		<?php
		// memanggil file koneksi
		include_once("conn.php");

		// mengecek isi dari inputan form diatas
		if(isset($_POST['submitPembeli'])) {
			$nama = $_POST['nama'];
			$UserName = $_POST['email'];
			$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
			
			// mengecek nama email
			$sameUser = 0;
			$user = mysqli_query($koneksi,"SELECT UserName FROM user");
			if(mysqli_num_rows($user) > 0){
				while ($row = mysqli_fetch_assoc($user)){
					if ($UserName == $row["UserName"]){
						$sameUser = 1;
						break;
					}
				}
			}

			if($sameUser == 1){
				alert("Usename atau Email telah dipakai");
			}else{
				// menambahkan inputan ke database
				$result = mysqli_query($koneksi, "INSERT INTO user(UserName,pass,nama) VALUES('$UserName','$pass','$nama')");
				$message = 'Data berhasil disimpan';

				alert($message,"../index.php");
		    mysql_close();
			}
		}
		?>

	</div>

	<div id="penjual" style="float: left;display: none;">
		<form class="formulir" method="POST" name="form-penjual" action="" onsubmit="isemptyPenjual()" >
			<div class="container row #fff8e1 amber lighten-5" style="color: black;padding: 40px;border-radius: 30px;">

				<p class="col s4">Nama - Toko :</p>		 <input class="col s8" type="text" name="toko">
				<p class="col s4">Email :</p>			 <input class="col s8" type="text" name="email">
				<p class="col s4">Lokasi - Toko :</p>			 <input class="col s8" type="text" name="lokasi">
				<p class="col s4">Password :</p>		 <input onkeyup='checkPenjual();'class="col s8" type="password" id="PenjualpassId" name="pass">
				<p class="col s4">Repeat - Password :</p><input onkeyup='checkPenjual();'class="col s8" type="password" id="PenjualrPassId"name="rPass">

				<button name="submitPenjual" id="submitPenjual" class="btn waves-effect waves-light disabled" type="submit" style="margin-top: 20px;">Submit
			    	<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
		<?php
		// memanggil file koneksi
		include_once("conn.php");

		// mengecek isi dari inputan form diatas
		if(isset($_POST['submitPenjual'])) {
			$toko = $_POST['toko'];
			$UserName = $_POST['email'];
			$lokasi = $_POST['lokasi'];
			$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

			// mengecek nama email
			$sameUser = 0;
			$user = mysqli_query($koneksi,"SELECT UserName FROM user");

			if(mysqli_num_rows($user) > 0){
				while ($row = mysqli_fetch_assoc($user)){
					if ($UserName == $row["UserName"]){
						$sameUser = 1;
						break;
					}
				}
			}

			if($sameUser == 1){
				alert("Usename atau Email telah dipakai");
			}else{
				// menambahkan inputan ke database
				$resultUser = mysqli_query($koneksi, "INSERT INTO user(UserName,pass,nama) VALUES('$UserName','$pass','$toko')");
				$resultToko = mysqli_query($koneksi, "INSERT INTO toko(nama,lokasi) VALUES('$toko','$lokasi')");
				
				 $message = 'Data berhasil disimpan';

		    alert($message,"../index.php");
		    mysql_close();
			}
		}

		function alert($msg,$loc="") {
    	echo "<script type='text/javascript'> 
    						alert('$msg'); 
    						window.location.replace('$loc');
    				</script>";
		}
		?>
	</div>


</body>
	<script>

		function checkPembeli() {
		  if (document.getElementById('PembelipassId').value ==
		    document.getElementById('PembelirPassId').value) {
		    document.getElementById('submitPembeli').classList.remove('disabled');
		  } else {
		    document.getElementById('submitPembeli').classList.add('disabled');
		  }
		}

		function checkPenjual() {
		  if (document.getElementById('PenjualpassId').value ==
		    document.getElementById('PenjualrPassId').value) {
		    document.getElementById('submitPenjual').classList.remove('disabled');
		  } else {
		    document.getElementById('submitPenjual').classList.add('disabled');
		  }
		}

		function isemptyPembeli() {
			if(document.forms['form-pembeli'].nama.value === "" ||
			   document.forms['form-pembeli'].email.value === "" || 
			    document.forms['form-pembeli'].pass.value === ""){
				alert("Masukkan semua data...")
				return false;
			}else{
				return true;
				
			}

		}
		function isemptyPenjual() {
			if(document.forms['form-penjual'].nama.value === "" ||
			   document.forms['form-penjual'].email.value === "" || 
			   document.forms['form-penjual'].pass.value === "" ||
			   document.forms['form-penjual'].toko.value === "" ){

				alert("Masukkan semua data...")
				return false;

			}else{
				return true;
			}

		}

		function pembeli() {
		  var x = document.getElementById("pembeli");
		  var y = document.getElementById("penjual")
		  if (x.style.display === "none") {
		    x.style.display = "block";
		    y.style.display = "none";
		  } else {
		    x.style.display = "none";
		  }
		}
		function penjual() {
		  var x = document.getElementById("penjual");
		  var y = document.getElementById("pembeli")
		  if (x.style.display === "none") {
		    x.style.display = "block";
		    y.style.display = "none";
		  } else {
		    x.style.display = "none";
		  }
		}
	</script>

</html>

<script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
  crossorigin="anonymous"
></script>
<script
  src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
  integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
  crossorigin="anonymous"
></script>
<script
  src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
  crossorigin="anonymous"
></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"
></script>
<script src="./js/jquery.instagramFeed.min.js"></script>