<?php 
session_start();
 if (!isset($_SESSION["nama"])){
 	header("Location: login.php");
 exit;
 }

 require 'funcations.php';

//Format Tanggal dan Tahun Otomatis
$today= date("dmy");
$query = "SELECT max(npm) AS last FROM tabel_mahasiswa WHERE npm LIKE '$today%'";
$hasil = mysqli_Query($conn,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
$lastNoUrut = substr($lastNoTransaksi, 8, 2);
$nextNoUrut = $lastNoUrut + 1;
$nextNoTransaksi = $today.sprintf(".%03s", $nextNoUrut);



//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {


	

    if(  tambah ($_POST) > 0){ 
       echo "
		 <script>
		     alert('data berhasil di masukan!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";

      }else{

		echo "
		 <script>
		     alert('data gagal di masukan!');
		     die;
		     document.location.href ='tambah.php';

		 </script>
		 ";

	}
}





 ?>
  <script>

var pesan = confirm('apakah kamu yakin ingin Menambahkan Data??');
if (pesan == true){
   alert('data berhasil di masukan!');
   document.location.href ='latihan1.php';
	</script>

<!DOCTYPE html> 
<html>
<head>
	<title>Tambah Mahasiswa</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="input.css">	
	<link rel="stylesheet" type="text/css" href="tmh.css">
	<link rel="stylesheet" type="text/css" href="btntambah.css">
	<script type="text/javascript" src ="js/bootstrap.min.css"></script>	
</head>
<body class="form-group">
<div class="form-input">
	<div class="judul-form">
		Form Input Mahasiswa
	</div>
	<br>
<form action="" method="post" enctype="multipart/form-data">		
	<div class="npm">	
		<label class="lbl-gmr"> NPM </label>
		<input type="text" name="npm" minlength="6" id="npm" class="inpt-npm"  placeholder="Npm" style="color: black; font-style: italic;" required value="<?php echo $nextNoTransaksi; ?>">
	</div>
		<br>
	<div class="nama-mhs">
		<label class="lbl-gmr">NAMA </label>
		<input type="text" name="nama" id="nama" class="inpt-nama" placeholder="Nama Anda" style="color: black; font-style: italic;"  required>
	</div>
		<br>
		<div class="gambar-input">
			<label class="lbl-gmr">GAMBAR </label>
			<input  class="inpt-gambar" type="file" name="gambar"  id="gambar">
		</div>
		<br>

	<div class="jrs-mhs">
		<label class="lbl-gmr">JURUSAN </label>
		<input type="text" name="jurusan" id="jurusan" placeholder="Jurusan" class="inpt-jurusan" style="color: black; font-style: italic;"  required>
	</div>
		<br>
	<div class="alm-mhs">
		<label class="lbl-gmr">ALAMAT </label>
		<input type="text" name="alamat" id="alamat"  placeholder="Alamat"  class="inpt-alamat" style="color: black; font-style: italic;" required>
	</div>
		<br>
	<div class="tlp-mhs">
		<label class="lbl-gmr">TELEPON </label>
		<input type="text" name="telepon" id="telepon" placeholder="Telepon" class="inpt-telepon" style="color: black; font-style: italic;" required>
	</div>
	<br>
			
	<div class="btn-mhs">	
		<button type="submit" class="btn btn-success" name="submit" onclick="	return  confirm('apakah kamu yakin ingin Menambahkan Data??')">Tambah Data!</button>
		<button type="reset" class="btn btn-danger" name="reset"  value="clear">Batal</button>
	</div>
		
	</form>
		</div>
	

</body>
</html>