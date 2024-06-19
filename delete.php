<?php
//koneksi ke engine mysql
$conn = mysqli_connect("localhost","root","");
if (!$conn){
	die ("Koneksi ke Engine MySQL Gagal !<br>");
}
$db = mysqli_select_db($conn, "si_karyawan");
if (!$db){
	die ("Koneksi ke Database Gagal !");
}
// Cek nik
if (isset($_GET['nik'])) {
	$nik = $_GET['nik'];
	// membaca nama file yang akan dihapus
	$query   = "SELECT * FROM data_karyawan WHERE nik='$nik'";
	$hasil   = mysqli_query($conn, $query);
}
else {
	die ("Error. Tidak ada NIK yang dipilih. Silakan cek kembali!");	
}
//proses hapus data
	if (!empty($nik) && $nik != "") {
		$hapus = "DELETE FROM data_karyawan WHERE nik='$nik'";
		$sql = mysqli_query($conn, $hapus);
		if ($sql) {		
			?>
				<script language="JavaScript">
					alert('Seluruh Data Karyawan <?=$nik?> berhasil dihapus!');
					document.location='index.php?page=lihat';
				</script>
			<?php		
		} else {
			echo "<h2><font color=red><center>Data Karyawan gagal dihapus</center></font></h2>";	
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($conn);
?>