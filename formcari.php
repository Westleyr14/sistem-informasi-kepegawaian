<div style="border:1px solid rgb(238,238,238); padding:10px; overflow:auto; width:1110px; height:450px;">
<form action="" method="POST" name="pencarian" id="pencarian">
	<strong>Pencarian  :</strong>
	<input type="text" name="search" id="search" size="20">&nbsp;* isi nama depan karyawan<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="submit" id="submit" value="CARI">
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
if ((isset($_POST['submit'])) AND ($_POST['search'] <> "")) {
  $search = $_POST['search'];
  $sql = mysqli_query($conn, "SELECT * FROM data_karyawan WHERE nama LIKE '$search%' ") or die(mysqli_error());
	//menampilkan jumlah hasil pencarian
  $jumlah = mysqli_num_rows($sql); 
  if ($jumlah > 0) {
    echo '<p>Ada '.$jumlah.' data yang sesuai.</p>';
	$no=0;
    while (	$hasil = mysqli_fetch_array($sql)) {
		$nik = stripslashes ($hasil['nik']);
		$nama = stripslashes ($hasil['nama']);
		$namafoto = stripslashes ($hasil['namafoto']);
		$foto = $hasil['namafoto'];
		$jk = stripslashes ($hasil['jk']);
		$jab = stripslashes ($hasil['jab']);
		$dept = stripslashes ($hasil['dept']);
		$tmp_lhr = stripslashes ($hasil['tmp_lhr']);
		$tgl = explode ("-", $hasil['tgl_lhr']);
			$tgl_lhr = "$tgl[2]-$tgl[1]-$tgl[0]"; //konversi tanggal ke format 00-00-0000
		$gol_darah = stripslashes ($hasil['gol_darah']);
		$agama = stripslashes ($hasil['agama']);
		$status = stripslashes ($hasil['status']);
		$telp = stripslashes ($hasil['telp']);
		$email = stripslashes ($hasil['email']);
		}
		$no++;
?>
<table width="1420" border="0" align="center" cellpadding="5" cellspacing="0">
<tr bgcolor="#FFA800">
	<th width="30">No</td>&nbsp;
	<th width="60" height="42">NIK</td>&nbsp;
	<th width="180">Nama</td>&nbsp;
	<th width="100">Foto</td>&nbsp;      
	<th width="55">Jenis Kelamin</td>&nbsp;
	<th width="70">Jabatan</td>&nbsp;
	<th width="100">Departemen</td>&nbsp;
	<th width="80">Tempat Lahir</td>&nbsp;
	<th width="90">Tanggal Lahir</td>&nbsp;
	<th width="50">Gol Darah</td>&nbsp;
	<th width="70">Agama</td>&nbsp;
	<th width="60">Status Kawin</td>&nbsp;
	<th width="110">Telpon</td>&nbsp;
	<th width="200">Email</td>&nbsp;
	<th width="100">Action</td>&nbsp;     
</tr>
  
	<?php 
		if ($no > 1) {
			echo '<tr align="center" bgcolor="#DFE6EF"><td colspan="15">&nbsp;</td></tr>';
		}
	?>
	<tr align="center">
		<td><?=$no?>
		<div align="center"></div></td>
		<td><?=$nik?>
		<div align="center"></div></td>
		<td><?=$nama?>
		<div align="center"></div></td>
		<td style="padding: 10px 5px;"><?php
			if (empty($foto)) 
		        echo "<img src='images/nopic.gif' width='90' height='110'> <br> <p style='text-align: center; margin: 10px 0 0 0;'><strong>No Image</strong></p>";
		        else
				echo "<img class='shadow' src='images/$foto' width='90' height='110' title='$nama' >";
				?>&nbsp;</td>
		<td><?=$jk?><div align="center"></div></td>
		<td><?=$jab?><div align="center"></div></td>
		<td><?=$dept?><div align="center"></div></td>
		<td><?=$tmp_lhr?><div align="center"></div></td>
		<td><?
			if ($hasil['tgl_lhr'] === NULL)
				$tgl_lhr = "NULL"; 
			else
				$tgl_lhr = date('d F Y', strtotime($tgl_lhr));
				echo("$tgl_lhr\n");
		?><div align="center"></div></td>
		<td><?=$gol_darah?><div align="center"></div></td>
		<td><?=$agama?><div align="center"></div></td>
		<td><?=$status?><div align="center"></div></td>
		<td><?=$telp?><div align="center"></div></td>
		<td><?=$email?><div align="center"></div></td>
		<td bgcolor="#EEF2F7"><div align="center"><a href="index.php?page=detail&nik=<?=$nik?>">Detail</a> | <a href="index.php?page=delete&nik=<?=$nik?>" OnClick="return confirm('Yakin data <?=$nama?> akan dihapus?');">Delete</a></div></td>
	</tr>
	<?php 
		if ($no < $jumlah) {
			echo '<tr align="center" bgcolor="#DFE6EF"><td colspan="15">&nbsp;</td></tr>';
		}
	?>
</table>
<?php
    }
	else {
   // menampilkan pesan zero data
		echo 'Maaf, hasil pencarian tidak ditemukan.';
	}
}
//Tutup koneksi engine MySQL
	mysqli_close($conn);
?>
</div>