<div style="border:1px solid rgb(238,238,238); padding:10px; overflow:auto; width:1110px; height:450px;">
<form action="" method="POST" name="cariedit" id="cariedit">
	<strong>Edit Data  :</strong>
	<input type="text" name="cariedit" id="cariedit" size="20" maxlength="16">&nbsp;* isi NIK untuk data karyawan yang akan diedit<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="submit" id="submit" value="GO">
</form>
<?php
$conn = mysqli_connect("localhost","root","");
	if (!$conn){
	die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
$db = mysqli_select_db($conn, "si_karyawan");
	if (!$db){
	die ("Koneksi ke Database Gagal !");
	}
//menampilkan data
if ((isset($_POST['submit'])) AND ($_POST['cariedit'] <> "")) {
  $nik = $_POST['cariedit'];
  $sql = mysqli_query($conn, "SELECT * FROM data_karyawan WHERE nik='$nik' ") or die(mysqli_error());
	$hasil = mysqli_fetch_array($sql);
	$nik = stripslashes ($hasil['nik']);
	$nama = stripslashes ($hasil['nama']);
	if (!$hasil) {
		echo 'Maaf, NIK yang dimasukan tidak terdapat dalam database!'; // menampilkan pesan zero data
	} else {
?>
<table width="910" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr></tr>
</table>
<?php
		echo '<p>NIK = <font color="#FF6600"><strong>'.$nik.'</strong></font>, dengan Nama = <font color="#FF6600"><strong>'.$nama.'</strong></font> berhasil ditemukan.</p>
			 <p>Lanjutkan edit data?</p>
			 <ol><font color="green" size="3" face="arial">
					<li style="margin-bottom: 5px;"><a href="index.php?page=edit&nik='.$nik.'">Ya</a></li>
					<li><a href="index.php?page=formedit">Tidak</a></li>
				</font></ol>';
	} 
}
//Tutup koneksi engine MySQL
	mysqli_close($conn);
?>
</div>