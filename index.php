<html>
<head>
<title>Sistem Informasi Kepegawaian</title> 
<link href="css/style.css" rel="stylesheet" type="text/css"> 
</head>
<body>
<br>
<table class="main-table">
<tr>
	<td width="10" bgcolor="#2a3b91">&nbsp;</td>
	<td width="140" height="120" bgcolor="#2a3b91"></td>
	<td width="10" bgcolor="#2a3b91">&nbsp;</td>
	<td width="1136" bgcolor="#2a3b91"><div id="header" align="center">
	<b>Sistem Informasi Kepegawaian</b>
	<td width="10" bgcolor="#2a3b91"></td>
</tr>
<tr bgcolor="#F8F8FF">
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr bgcolor="#F8F8FF">
	<td>&nbsp;</td>
	<td rowspan="4" valign="top"><nav>
		<ul class="navbar">
			<li><a href="index.php" title="Home">&nbsp;Home</a></li>
			<li><a href="index.php?page=forminputkaryawan" title="Input Data">&nbsp;Input</a></li>
			<li><a href="index.php?page=lihat" title="Lihat Data">&nbsp;Lihat</a></li>
			<li><a href="index.php?page=formedit" title="Edit Data">&nbsp;Edit</a></li>
			<li><a href="index.php?page=formcari" title="Cari Data">&nbsp;Cari</a></li>
			<li><a href="index.php?page=about" title="Tentang Program">&nbsp;About</a></li>
		</ul>
	</nav></td>
	<td rowspan="4">&nbsp;</td>
	<td rowspan="4" valign="top"><table width="1136" height="500" bgcolor="white" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="936" valign="top">
			<?php
			$page = (isset($_GET['page']))? $_GET['page'] : "main";
			switch ($page) {
				case 'about': include "about.php"; break;
				case 'delete': include "delete.php"; break;
				case 'detail'	: include "detail.php"; break;
				case 'formedit'	: include "formedit.php"; break;
				case 'edit' : include "edit.php"; break;
				case 'formcari' : include "formcari.php"; break;
				case 'forminputkaryawan' : include "forminputkaryawan.php"; break;
				case 'lihat' : include "lihat.php"; break;
				case 'main' :
				default : include 'about.php';	
			}
			?></td>	
		</tr></table></td>
	<td rowspan="4">&nbsp;</td>
</tr>
<tr bgcolor="#F8F8FF">
    	<td>&nbsp;</td>
</tr>
<tr bgcolor="#F8F8FF">
    	<td>&nbsp;</td>
</tr>
<tr bgcolor="#F8F8FF">
    	<td>&nbsp;</td>
</tr>
<tr bgcolor="#F8F8FF">
    	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>	
</tr>
<tr bgcolor="#2a3b91">
	<td height="36" colspan="5" bgcolor="#2a3b91"><div align="right" style="margin:0 10px 0 0;"><font color="#FFFFE0">Kelompok 1 R63</font><br></div></td>
</tr>
</table>
<div align="center"></div>
</body>
</html>