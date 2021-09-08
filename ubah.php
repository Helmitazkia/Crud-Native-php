<?php 

 session_start();
 
 if (!isset($_SESSION["nama"])){
 	header("Location: login.php");
 exit;
 }
 require 'funcations.php';

 // ambil data di url
$id = $_GET["id"];

$mhs= helmi("select * from tabel_mahasiswa where npm = $id")[0];

//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {

	//cek apakah edit ada sudah berhasill di ubah


	if(  ubah ($_POST) > 0) {
       echo "
		 <script>
		     alert('data berhasil di edit!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
      }else{

		echo "
		 <script>
		     alert('data gagal di edit!');
		     die;
		    document.location.href ='latihan1.php';

		 </script>
		 ";

	}

}


 ?>
   <script>

var pesan = confirm('apakah kamu yakin ingin Mengubah Data??');
if (pesan == true){
   alert('data berhasil di masukan!');
   document.location.href ='latihan1.php';
	</script>

<!DOCTYPE html>
<html>
<head>
	<title> Ubah Mahasiswa</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="input.css">	
	<link rel="stylesheet" type="text/css" href="updategroup.css">
	<link rel="stylesheet" type="text/css" href="gambar.css">
	<link rel="stylesheet" type="text/css" href="btntambah.css">
	<script type="text/javascript" src ="js/bootstrap.min.css"></script>
</head>
<body class="form-group">
<div class="form-input">
	<div class="judul-form">
		Form Ubah Mahasiswa
	</div>
	<br>

	<form action="" method="post" enctype="multipart/form-data">
	<div class="npm-update">
		<label class="lbl-gmr" for="nrp"> NPM</label>
		<input type="text" class="inpt-npm"  name="npm" id="nrp" required value="<?php echo $mhs ["npm"]; ?>">
		<input type="hidden" name="gambarlama"  required value="<?php echo $mhs ["gambar"]; ?>">
	</div>
		<br>
	<div>
		<label class="lbl-gmr" for="nama">NAMA</label>
		<input type="text" name="nama" class="inpt-nama" id="nama" required  value="<?php echo $mhs["nama"]; ?>">
	</div>
		<br> 
	<div class="gmbr-update">
	    <img src="BBB/<?php echo $mhs["gambar"]; ?>" width="120"><br>
        <input  class="file-input" type="file" name="gambar" id="gambar" >
	</div>
		<br>
	<div>
		<label class="lbl-gmr" for="jurusan">JURUSAN</label>
		<input type="text" class="inpt-jurusan" name="jurusan" id="jurusan" required  value="<?php echo $mhs["jurusan"]; ?>">
	</div>
		<br>
	<div>
		<label class="lbl-gmr" for="alamat">ALAMAT</label>
		<input type="text" class="inpt-alamat" name="alamat" id="alamat" required value="<?php echo $mhs["alamat"]; ?>">
	</div>
		<br>
	<div>
		<label  class="lbl-gmr" for="telepon">TELEPON</label>
		<input type="text" class="inpt-telepon" name="telepon" id="telepon" required value="<?php echo $mhs["telepon"]; ?>">
	</div>
	<br>
		<div class="btn-mhs"> 	
			<button type="submit" class="btn btn-primary" name="submit" onclick="return  confirm('apakah kamu yakin ingin Mengubah Data??')" >Edit Data!</button>
		</div>
	</div>

	</form>


</body>
</html>