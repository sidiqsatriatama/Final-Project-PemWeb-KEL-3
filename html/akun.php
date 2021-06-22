<?php
  include_once("./conn.php");
    session_start();
    if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))){
        header("Location: login.php");
    }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pasar</title>
	<link rel="stylesheet" type="text/css" href="../style/main.css">
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	<link
      href="https://fonts.googleapis.com/css?family=Oxygen"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
      integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

</head>
<body>

	<nav
      id="fm-navbar"
      class="navbar sticky-top navbar-expand-lg "
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
          <img src="../img/logo.png" id="logo" alt="" style="max-height: 50px;max-width: 50px;margin: 7px;"/>
        </a>

        <div class="search-container">
          <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>

        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
            <li class="nav-item">
              <a class="nav-link pr-color" href="../index.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link pr-color" href="./kategori.html"
                >Kategori</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link pr-color" href="./login.php"> My profile </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pr-color" href="./About.html"
                >About us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="profile container" style="padding: 200px 0px 100px 100px ;color: #FFA826;">
      <?php 
        if(isset($_SESSION['toko'])){
          echo '<h3 class="col-md-6">Nama - Toko : '. $_SESSION['toko'] . '</h3> ';
          echo '<h3 class="col-md-6">Alamat  : '. $_SESSION['alamat'] . '</h3> ';
          echo '<h3 class="col-md-6">Email  : '. $_SESSION['username'] . '</h3> ';
          echo '<button type="button" style="margin:20px 0px 30px 30px;" class="btn btn-outline-warning">Edit</button>';
        }else{
          echo '<h3 class="col-md-6">Nama : '. $_SESSION['nama'] . '</h3> ';
          echo '<h3 class="col-md-6">Email  : '. $_SESSION['username'] . '</h3> ';
          echo '<button type="button" style="margin:20px 0px 30px 30px;" class="btn btn-outline-warning">Edit</button>';

        }
      ?>
      <a href="logout.php"><button type="button" style="margin:20px 0px 30px 30px;" class="btn btn-outline-warning">Logout</button></a>
    </div>
    <?php if(isset($_SESSION['toko'])){
      ?>
    
    <div id="barang" class="container-fluid float-left horizontal-scrollable" style="background-color: #FFA826; padding: 64px;">
        <img class="col-sm" style="max-height: 128px;max-width: 128px; position: absolute;left: -2px;margin-top: 32px;" src="../img/exLogo.png">
        <?php
          $idToko = $_SESSION["idToko"];
          $barangQuery = mysqli_query($koneksi,"SELECT * FROM `barang` WHERE `idToko` = '$idToko'");

          if(mysqli_num_rows($barangQuery) > 0){
            while ($row = mysqli_fetch_assoc($barangQuery)){
              $idini = $row["idBarang"];
              ?><a href="" style="cursor: context-menu;color: black; text-decoration: none;">
              <div class="card col" style="width: 16rem;padding-top: 10px;">
                      <img style="max-height: 230px;max-width: 256px;" class="card-img-top" src="image_view.php?idbarang=<?php echo $idini; ?>" alt="Image not load">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row["nama"] ?></h5>
                        <p class="card-text" style="height: 45px; overflow: hidden;"><?php echo $row["deskripsi"] ?></p>
                        <a href="barang.php?idbarang=<?php echo $idini; ?>" class="btn btn-primary col">Lihat Barang</a>
                      </div>
                    </div>
                    </a>
              <?php
            }
          } 
          ?>
          <div onclick="tampilBarang()" id="tambah" class="card " style="width: 16rem; text-align: center;padding-top:7rem;"><i style="font-size:128px;color:#FFA826;cursor: pointer;" class="fa fa-plus-square-o" aria-hidden="true"></i></div>
        
    </div>


    <div id="formBarang" style="display: none;z-index: 3;position: absolute; left: 10%;background-color: #fff8e1;width: 80%;height: 100%;border-radius: 30px;margin: 32px;" class="formBarang container">
      <i onclick="tampilBarang()" class="fa fa-times" aria-hidden="true" style="margin:16px;cursor: pointer;"></i>

      <form name="formupload" enctype="multipart/form-data" action="" method="post">
            <label class="col-4">Nama Barang : </label><input class="col-6 input" type="text" name="nama"> <br /> 
            <label class="col-4">Harga Barang  : </label><input class="col-6 input" type="number" min="1" name="harga"> <br />
            <label class="col-4" style="font-size: 14px;color: grey;">(Hanya angka tanpa tanda baca) ex : 10000)</label><br/>
            <label class="col-4" style="float:left;">Deskripsi Barang : </label> <textarea style="float: left;" class="col-6 form-control" rows="3" name="deskripsi"></textarea><br /> <br /> <br /> <br /> <br /> 
            <label class="col-4">stok Barang : </label><input class="col-6 input" type="number" name="stok" min="1" name="harga"> <br />  
            <label class="col-4">Upload Gambar ( jpg/png ) : </label><input class="col-6" name="gambar" type="file" /> <br /> 
            
            <button type="submit" name="tambahBarang" style="margin-left: 10px;" class="btn btn-info">Tambah barang <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
      </form>
      
      <?php 

      if(isset($_POST['tambahBarang'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $terjual = 0;
        $idToko = $_SESSION['idToko'];

        $file_name = $_FILES['gambar']['name'];
        $file_size = $_FILES['gambar']['size'];
        $file_type = $_FILES['gambar']['type'];
        if ($file_size < 1048000 and ($file_type =='image/jpeg' or $file_type == 'image/png'))
        {
          //Barang handler
          $query = mysqli_query($koneksi, "INSERT INTO barang(nama,harga,deskripsi,stok,terjual,idToko) VALUES('$nama','$harga','$deskripsi','$stok','$terjual','$idToko')");
          $idQuery= mysqli_query($koneksi,"SELECT Max(idBarang) AS maximum FROM barang");
          $row = mysqli_fetch_assoc($idQuery); 
          $idBarang = $row['maximum'];

          //Image handler
          $image   = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
          $imageQuery = mysqli_query($koneksi,"INSERT into gambar(foto,idBarang,tipe_gambar) values ('$image','$idBarang','$file_type')");
          alert("Barang berhasil ditambahkan");
          
          
        }else{
            alert("Tambah barang gagal, extensi gambar adalah jpg dan kurang dari atau sama dengan 1 mb");
        }
      }}

      function alert($msg,$loc="") {
      echo "<script type='text/javascript'> 
                alert('$msg'); 
                window.location.replace('$loc');
            </script>";
    }
    ?>
    
    </div>
    
    <div class="report">
      
  <div class="tengah container" style="overflow-x: auto;white-space: nowrap;">
    <div class="container" style="margin-top: 100px;">
      <h1 style="text-align: center;">Data Barang yang dijual</h1><br>
    </div>
    <div class="card-body container">
      <div class="form-group">
        <table border="1" class="tulis">
          <tr>
            <th style="padding: 10px;">No</th>
            <th class="col-3">Nama Barang</th>
            <th class="col-2">Harga</th>
            <th class="col-2">Stok</th>
            <th class="col-2">Terjual</th>
            <th class="col-4">Deskripsi</th>

          </tr>
          <?php  
          $no = 0;
            if (is_array($barangQuery) || is_object($barangQuery))
            {

            foreach ($barangQuery as $row ) {
              $no = $no+1;
            echo  "<tr>
                  <td style='padding: 10px;'>".$no."</td>
                  <td style='padding: 10px;'>".$row['nama']."</td>
                  <td style='padding: 10px;'>".$row['harga']."</td>
                  <td style='padding: 10px;'>".$row['stok']."</td>
                  <td style='padding: 10px;'>".$row['terjual']."</td>
                  <td style='padding: 10px;'>".$row['deskripsi']."</td>
                </tr><br>";
            }
            
          }
          ?>

        </table>


          <div class="form-group container" style="margin-top:20px;">
            <div class="col-sm-10">
              <button type="submit" name="excel" class="btn btn-primary"><a href="fileHandler/toExcel.php" style="color: white;text-decoration: none;">Export ke Excel</a></button>
              <button type="submit" name="pdf" class="btn btn-primary"><a href="fileHandler/toPdf.php" style="color: white;text-decoration: none;">Export ke PDF</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="grafik tengah container" style="margin: 10%;">
      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
 
      <?php
       $dataPoints = [];
       $idToko = $_SESSION["idToko"];
       $barangQuery = mysqli_query($koneksi,"SELECT * FROM `barang` WHERE `idToko` = '$idToko'");
        if(mysqli_num_rows($barangQuery) > 0){
            while ($row = mysqli_fetch_assoc($barangQuery)){
              array_push($dataPoints, array("y" => $row["terjual"],"label" => $row["nama"]));
            }}
      ?>
      <script>
        window.onload = function() {
         
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          theme: "light2",
          title:{
            text: "Penjualan Barang"
          },
          axisY: {
            title: "Penjualan Barang (Per Unit)"
          },
          data: [{
            type: "column",
            yValueFormatString: "#,##0.## tonnes",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
          }]
        });
        chart.render();
         
        }
    </script>
    </div>
  </div>
</body>

  <script type="text/javascript">
    function tampilBarang() {
      var x = document.getElementById("barang");
      var y = document.getElementById("formBarang");
      if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
        y.style.display = "none";
      } else {
        x.style.visibility = "hidden";
        y.style.display = "block";
      }
    }
      

  </script>
</html>