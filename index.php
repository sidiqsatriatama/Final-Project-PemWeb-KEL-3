<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pasar</title>
	<link rel="stylesheet" type="text/css" href="style/main.css">


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

</head>
<body>
	<nav
      id="fm-navbar"
      class="navbar sticky-top navbar-expand-lg "
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
          <img src="./img/logo.png" id="logo" alt="" style="max-height: 50px;max-width: 50px;margin: 7px;"/>
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
              <a class="nav-link pr-color" href="./index.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link pr-color" href="./html/kategori.html"
                >Kategori</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link pr-color" href="./html/login.php"> My profile </a>
            </li>
            <li class="nav-item">
              <a class="nav-link pr-color" href="./html/About.html"
                >About us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="pos-f-t">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h4 class="text-white">Collapsed content</h4>
      <span class="text-muted">Toggleable via the navbar brand.</span>
    </div>
    
  </div>
    <div class="header row" style="width: 100%;">
      <div class="col s4 ">
        <div style="padding: 200px 0px 80px 100px ;color: #FFA826;">
          <h1>Onnary</h1>
          <h4>A place where you can feel by looking at it </h4>
          <div class="left">
            <a href="html/signUp.php"><button type="button" class="btn btn-warning" >Sign Up</button></a>
            <a href="html/login.php"><button type="button" class="btn btn-outline-warning">Login</button> </a>         

          </div>
        </div>
      </div>
      <div class="col s4" > <img class="responsive-img" style="max-width: 80%;margin: 80px;margin-right: 0px;" src="./img/Banner.png"></div>
    </div>



  <br>
  <div class="terlaris container-fluid" style="padding: 64px ;">
    <h1 class="col" style="position: absolute;left: 10%;color: #FFA826;">Terlaris saat ini :</h1><br><br><br>
  <?php 
    include_once("html/conn.php");
    $barangQuery = mysqli_query($koneksi,"SELECT * FROM `barang` ORDER BY `terjual` DESC limit 6");
      if(mysqli_num_rows($barangQuery) > 0){
        while ($row = mysqli_fetch_assoc($barangQuery)){
          $idini = $row["idBarang"];
          ?>
          <div class="card col" style="width: 16rem;padding-top: 10px;">
              <img style="max-height: 230px;max-width: 256px;" class="card-img-top" src="html/image_view.php?idbarang=<?php echo $idini; ?>" alt="Image not load">
              <div class="card-body">
                  <h5 class="card-title"><?php echo $row["nama"] ?></h5>
                  <p class="card-text" style="height: 45px; overflow: hidden;"><?php echo $row["deskripsi"] ?></p>
                  <a href="html/barang.php?idbarang=<?php echo $idini; ?>" class="btn btn-primary col">Lihat Barang</a>
                </div>
          </div>
      <?php
            }
          }?>
  </div>

  





</body>
</html>

<script src="style/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=&v=weekly"
        async
        ></script>
<script src="./js/script.js"></script>

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
