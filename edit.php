<div style="border:1px solid rgb(238,238,238); padding:10px; overflow:auto; width:1110px; height:375px;">
<?php
$conn = mysqli_connect("localhost","root","");
		if (!$conn){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
$db = mysqli_select_db($conn, "si_karyawan");
		if (!$db){
		die ("Koneksi ke Database Gagal !");
		}
if (isset($_GET['nik'])) {
	$nik = $_GET['nik'];
} else {
	die ("Error. No Nik Selected! ");	
}
//Tampilkan data dari tabel karyawan
	$query	= "SELECT * FROM data_karyawan WHERE nik='$nik'";
	$sql	= mysqli_query($conn, $query);
	$hasil	= mysqli_fetch_array($sql);
	$nik	= $hasil['nik'];
	$nama	= $hasil['nama'];
	$namafoto	= stripslashes ($hasil['namafoto']);
	$foto	= $hasil['namafoto'];
	$jk		= $hasil['jk'];
	$jab	= $hasil['jab'];
	$dept 	= $hasil['dept'];
	$tmp_lhr	= $hasil['tmp_lhr'];
	//Memecah tanggal
	list($thn,$bln,$tgl) = explode ("-",$hasil['tgl_lhr']);
	$gol_darah	= $hasil['gol_darah'];
	$agama		= $hasil['agama'];
	$status		= $hasil['status'];
	$telp		= $hasil['telp'];
	$email		= $hasil['email'];	
//proses edit data karyawan
if (isset($_POST['Edit'])) {
	$nik	= $_POST['hnik'];
	$nama	= $_POST['nama'];
	$jk		= $_POST['jk'];
	$jab	= $_POST['jab'];
	$dept	= $_POST['dept'];
	$tmp_lhr	= $_POST['tmp_lhr'];
	$tgl_lhr	= $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	$gol_darah	= $_POST['gol_darah'];
	$agama	= $_POST['agama'];
	$status = $_POST['status'];
	$telp	= $_POST['telp'];
	$email	= $_POST['email'];
	$namafoto	= $_FILES['foto']['name'];
	//Cek Photo
	if (strlen($namafoto)>0) {
		//upload Photo
		if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
			move_uploaded_file ($_FILES['foto']['tmp_name'], "images/".$namafoto);
			mysqli_query($conn, "UPDATE data_karyawan SET namafoto='$namafoto' WHERE nik='$nik'");
		}
	}
	//update
	$query = "UPDATE data_karyawan SET nama='$nama', jk='$jk', jab='$jab', dept='$dept', tmp_lhr='$tmp_lhr', tgl_lhr='$tgl_lhr', gol_darah='$gol_darah', agama='$agama', status='$status', telp='$telp', email='$email' WHERE nik='$nik'";
	$sql = mysqli_query($conn, $query);
	//setelah berhasil update
	if ($sql) {
		echo "<h3><font color=#8BB2D9><center><blink>Data Pribadi Karyawan Berhasil diedit</blink></center></font></h3>
			<input type='button' value='Back To View' onclick=location.href='index.php?page=lihat' title='kembali ke form lihat data'><br><br>";	
	} else {
		echo "<h3><font color=red><center>Data Pribadi Karyawan gagal diedit</center></font></h3>";	
	}
}
?>
<form action="#" method="POST" name="formedit" enctype="multipart/form-data">
<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="550">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="550"><font color="orange" size="4" face="arial"><b>Form Edit Data</b></font></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="550">&nbsp;</td>
		</tr>
		<tr bgcolor="#DFE6EF" height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="550" align="center"></td>
		</tr>
		<tr>
			<td width="18">&nbsp;</td>
			<td width="142" height="36">NIK</td>
			<td width="550">:<b><?=$nik?>
				<input type="hidden" name="hnik" value="<?=$nik?>"></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">Nama</td>
			<td><input type="text" name="nama" size="40" maxlength="30" value="<?=$nama?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">Foto</td>
			<td><?php if (empty($foto)) 
					echo "<img src='images/nopic.gif' width='150' height='180'> <br> <p style='text-align: center; margin: 10px 0 0 0;'><strong>No Image</strong></p>";
					else
					echo"<img class='shadow' align=left src='images/$foto' width='150' heigth='180'/ title='$nama'><br/><br/><br/><br/><br/>"
				?><?=$namafoto?><br><br><input type="file" name="foto" size="49"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">Jenis Kelamin</td>
			<td><input type="radio" name="jk" value="L" <?php echo ($jk=='L')?"checked":""; ?>>Laki-laki &nbsp;&nbsp;
				<input type="radio" name="jk" value="P" <?php echo ($jk=='P')?"checked":""; ?>>Perempuan</td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td height="36">Jabatan</td>
			<td><input type="text" name="jab" size="25" maxlength="15" value="<?=$jab?>"></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td height="36">Departemen</td>
			<td><input type="text" name="dept" size="25" maxlength="16" value="<?=$dept?>"></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td height="36">Tempat Lahir</td>
			<td><input type="text" name="tmp_lhr" size="25" maxlength="15" value="<?=$tmp_lhr?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">Tanggal Lahir</td>
			<td><select name="tgl">
			<?php
				for ($i=0; $i<=31; $i++) {
					$tg = ($i<10) ? "0$i" : $i;
					$sele = ($tg==$tgl)? "selected" : "";
					echo "<option value='$tg' $sele>$tg</option>";	
				}
			?>
				</select> - 
				<select name="bln">
			<?php
				for ($i=0; $i<=12; $i++) {
					$bl = ($i<10) ? "0$i" : $i;
					$sele = ($bl==$bln)?"selected" : "";
					echo "<option value='$bl' $sele>$bl</option>";	
				}
			?>
				</select> - 
				<select name="thn">
			<?php
				for ($i=1954; $i<=2005; $i++) {
					$th = ($i<1955) ? "0000" : $i;
					$sele = ($i==$thn)?"selected" : "";
					echo "<option value='$th' $sele>$th</option>";	
				}
			?>
				</select></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">Golongan Darah</td>
			<td><input type="radio" name="gol_darah" value="A" <?php echo ($gol_darah=='A')?"checked":""; ?>>A &nbsp;&nbsp;
				<input type="radio" name="gol_darah" value="AB" <?php echo ($gol_darah=='AB')?"checked":""; ?>>AB &nbsp;&nbsp;
				<input type="radio" name="gol_darah" value="B" <?php echo ($gol_darah=='B')?"checked":""; ?>>B &nbsp;&nbsp;
				<input type="radio" name="gol_darah" value="O" <?php echo ($gol_darah=='O')?"checked":""; ?>>O</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">Agama</td>
			<td><select name="agama">
				<option value="-" <?php echo ($agama=='-')?"selected":""; ?>>-pilihan-
				<option value="Islam" <?php echo ($agama=='Islam')?"selected":""; ?>>Islam
				<option value="Protestan" <?php echo ($agama=='Protestan')?"selected":""; ?>>Protestan
				<option value="Katolik" <?php echo ($agama=='Katolik')?"selected":""; ?>>Katolik
				<option value="Hindu" <?php echo ($agama=='Hindu')?"selected":""; ?>>Hindu
				<option value="Budha" <?php echo ($agama=='Budha')?"selected":""; ?>>Budha
				</select></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">Status Pernikahan</td>
			<td><select name="status">
				<option value="-" <?php echo ($status=='-')?"selected":""; ?>>-pilihan-
				<option value="TK" <?php echo ($status=='TK')?"selected":""; ?>>Belum Menikah
				<option value="K0" <?php echo ($status=='K0')?"selected":""; ?>>Menikah Belum Memiliki Anak
				<option value="K1" <?php echo ($status=='K1')?"selected":""; ?>>Menikah Memiliki 1 Anak
				<option value="K2" <?php echo ($status=='K2')?"selected":""; ?>>Menikah Memiliki 2 Anak
				<option value="K3" <?php echo ($status=='K3')?"selected":""; ?>>Menikah Memiliki 3 Anak
				<option value="K4" <?php echo ($status=='K4')?"selected":""; ?>>Menikah Memiliki 4 Anak
				<option value="K5" <?php echo ($status=='K5')?"selected":""; ?>>Menikah Memiliki 5 Anak
				</select></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">No. Telp</td>
			<td><input type="text" name="telp" size="25" maxlength="12" value="<?=$telp?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="36">E-Mail</td>
			<td><input type="text" name="email" size="50" maxlength="40" value="<?=$email?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="20">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Edit" class="btn btn-info" value="Edit Data">&nbsp;&nbsp;
				<input type="button" value="Cancel" class="btn btn-info" onclick="location.href='index.php?page=formedit'" title="kembali ke form edit data"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="32">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
<?php
//Tutup koneksi engine MySQL
	mysqli_close($conn);
?>
</div>