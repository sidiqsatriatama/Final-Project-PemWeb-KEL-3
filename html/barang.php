<?php
  include_once("conn.php");
    session_start();
    if(isset($_GET['idbarang'])) 
    {
        $query = mysqli_query($koneksi,"SELECT * FROM barang WHERE idBarang='".$_GET['idbarang']."'");
        $rowBarang = mysqli_fetch_array($query);
        $queryToko = mysqli_query($koneksi,"SELECT * FROM toko WHERE idToko='".$rowBarang['idToko']."'");
        $rowToko = mysqli_fetch_array($queryToko);
        $queryFoto = mysqli_query($koneksi,"SELECT * FROM gambar WHERE idBarang='".$_GET['idbarang']."'");
        $rowFoto = mysqli_fetch_array($queryFoto);
    }
    else
    {
        header('location:../index.php');
    }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Pasar</title>
  <link rel="stylesheet" type="text/css" href="../style/main.css">


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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  </style>

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

    <div class="container" style="color:#707070;">
      <div  class="carousel slide" data-ride="carousel">
        
        <!-- The slideshow -->
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="image_view.php?idbarang=<?php echo $rowBarang["idBarang"]; ?>" width="1100" height="500">
          </div>
          <?php 
          while($rowFoto = mysqli_fetch_assoc($queryFoto)){

            ?>
          <div class="carousel-item">
            <?php 
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $rowFoto['foto'] ).'" width="1100" height="500"/>'; ?>
          </div>
          <?php
          }
          
          ?>
        </div>
        
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>

    <h1>Nama Kuliner : <?php echo $rowBarang["nama"]; ?></h1> 
    <h2 style="float: right;"> Rp. <?php echo $rowBarang["harga"]; ?></h2>
    <h4>Deskripsi :  <br></h4>
    <h4 style="width:256px;height:256px;overflow: auto;"><?php echo $rowBarang["deskripsi"]; ?></h4>

      <h3 style="float: right;"> Stok Barang : <?php echo $rowBarang["stok"]; ?></h3><br><br>
      <h4 style="float: right;"> Terjual : <?php echo $rowBarang["terjual"]; ?></h4><br><br>

      <h2>Toko : <?php echo $rowToko["nama"]; ?></h2>
      <h2>Alamat Toko : <?php echo $rowToko["lokasi"]; ?></h2>
    </div>
</body>

</html>