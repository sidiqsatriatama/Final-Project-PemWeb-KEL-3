<?php
include('conn.php');
if(isset($_GET['idbarang'])) 
{
    $query = mysqli_query($koneksi,"SELECT * FROM gambar WHERE idBarang='".$_GET['idbarang']."'");
    $row = mysqli_fetch_array($query);
    header("Content-type: " . $row["tipe_gambar"]);
    echo $row["foto"];
}
else
{
    header('location:index.php');
}
?>