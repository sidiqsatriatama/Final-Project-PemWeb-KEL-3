<?php  
	include_once ('../conn.php');
	session_start();
	require_once ("dompdf/autoload.inc.php");
	use Dompdf\Dompdf;

	$dompdf = new Dompdf();
	$idToko = $_SESSION["idToko"];
	$barangQuery = mysqli_query($koneksi,"SELECT * FROM `barang` WHERE `idToko` = '$idToko'");
	
	$html ='<html><center><h3>Data Barang yang dijual</h3></center><br/><br/><hr/><br/>';
	$html .= '<table border = "1" width = "100%" >
					<tr>
						<th>No</th>
						<th>Nama Baranag</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Terjual</th>
						<th>Deskripsi</th>
					</tr>';
	$no = 1;
	while($row = mysqli_fetch_array($barangQuery)){
		$html .= "<tr>
				  <td >".$no."</td>
                  <td >".$row['nama']."</td>
                  <td >".$row['harga']."</td>
                  <td >".$row['stok']."</td>
                  <td >".$row['terjual']."</td>
                  <td >".$row['deskripsi']."</td>
								</tr>";
		$no++;
	}
	$html .="</html>";
	$dompdf->loadHtml($html);
	//setting ukuran dan orientasi kertas
	$dompdf->setPaper('A4','landscape');
	//rendering dari HTML ke PDF
	$dompdf->render();
	//melakukan output ke file PDF
	$dompdf->stream('Laporan_onnary.pdf');
?>