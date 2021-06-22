<?php  
	include_once ('../conn.php');
	session_start();
	require 'vendor/autoload.php';
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	$sheet->setCellValue('A1',	'No');
	$sheet->setCellValue('B1',	'Nama Barang');
	$sheet->setCellValue('C1',	'Harga');
	$sheet->setCellValue('D1',	'Stok');
	$sheet->setCellValue('E1',	'Terjual');
	$sheet->setCellValue('F1',	'Deskripsi');

    $idToko = $_SESSION["idToko"];
	$barangQuery = mysqli_query($koneksi,"SELECT * FROM `barang` WHERE `idToko` = '$idToko'");
	$i = 2;
	while($row = mysqli_fetch_array($barangQuery)){
		$sheet->setCellValue('A'.$i, $i-1);
		$sheet->setCellValue('B'.$i, $row['nama']);
		$sheet->setCellValue('C'.$i, $row['harga']);
		$sheet->setCellValue('D'.$i, $row['stok']);
		$sheet->setCellValue('E'.$i, $row['terjual']);
		$sheet->setCellValue('F'.$i, $row['deskripsi']);
		
		$i++;
	}

	$styleArray = [
		'borders' => [
			'allBorders' => [
				'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
			],
		],
	];
	$i = $i - 1;
	$sheet->getStyle('A1:T'.$i)->applyFromArray($styleArray);

	$writer = new Xlsx($spreadsheet);
	$writer->save('Data Barang.xlsx');
	echo ("<script LANGUAGE='JavaScript'>
    			window.alert('Data berhasil diexport');
    			window.location.href='Data Barang.xlsx';
    		</script>");
?>
