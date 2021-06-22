<?php
    session_start();
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])){
        header("Location: akun.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="../style/style2.css">
</head>
<body class="#ffcc80 orange lighten-3">

	<form method="POST" name="login" action="">
		<h3 class="center-align"><a href="../index.php" style="color: #fff;">Onnary Login</a></h3>
	<div class="form">
    	<input type="text" id="user" name="user" placeholder="Username..">
    	<input type="Password" id="passw" class="fas fa-eye" name="pass" placeholder="Password..">
	</div>
	<button name="submit" type="submit" class="button from-left">Login</button>
	<p style="font-size:15px; ">Belum punya akun? <a class="a text" href="signUp.php">Sign Up</a></p>
	</form>
	<?php
		include_once("conn.php");
		
		if(isset($_POST['submit'])) {
			$UserName = $_POST['user'];
			$pass = $_POST['pass'];
			
			// memanggil file koneksi
			
					
			$user = mysqli_query($koneksi,"SELECT * FROM user");
			if(mysqli_num_rows($user) > 0){
				while ($row = mysqli_fetch_assoc($user)){
					if ($UserName == $row["UserName"]){
						if(password_verify($pass, $row["pass"])){
							// Set session
							session_start();
							$_SESSION["username"] = $UserName;
							$_SESSION["nama"] = $row["nama"];
							$tokoQuery = mysqli_query($koneksi,"SELECT * FROM toko");
							if(mysqli_num_rows($tokoQuery) > 0){
								while ($rowToko = mysqli_fetch_assoc($tokoQuery)){
									if($rowToko["nama"] == $row["nama"]){
										$_SESSION["toko"] = $rowToko["nama"];
										$_SESSION["alamat"] = $rowToko["lokasi"];
										$_SESSION["idToko"] = $rowToko["idToko"];
										break;
									}
								}
							}

							// Redirect
							$message = 'Anda berhasil login';
		    				alert($message,"./akun.php");
							break;
						}

					}
				}
			}
			echo "<SCRIPT> 
		             alert('Password atau username salah...')
		    	  </SCRIPT>";
		}

		function alert($msg,$loc="") {
    	echo "<script type='text/javascript'> 
    						alert('$msg'); 
    						window.location.replace('$loc');
    				</script>";
		}
		?>
</body>
</html>