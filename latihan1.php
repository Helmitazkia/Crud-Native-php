<?php 
session_start();

//fungsi require untuk memanggil koneksi ke herp lain
 if (!isset($_SESSION["nama"])){
 	header("Location: login.php");
 exit;
 }


 require "funcations.php";
 //parameter Dara Form Login
 $u_user = $_SESSION["nama"];



//Fungsi Di bawah Ini untuk Meng Update Data username yang sudah login
if (isset ($_POST["lgt"])  ) 
{

	$sql = "SELECT status FROM tabel_user where username ='$u_user'";

	$data = mysqli_query($conn, $sql);
	if( mysqli_num_rows( $data ) > 0)
	{
	$user = mysqli_fetch_array( $data );
	//echo "<br>STATUS $user[status]<br>";

	$_SESSION['stat'] = $user['status'];
		if ($_SESSION['stat'] == 1)
		{
      
		 	$lg =mysqli_query($conn,"UPDATE  tabel_user SET status = '0' WHERE username='$u_user'");
		 	//$_SESSION['stat'] = $user['status'];
		 	session_start();
			$_SESSION = [];
		 	unset($_SESSION['nama']);
		 	session_destroy();
		 	header("Location: login.php");
		
		}
	}

}




//Panigation
//Konfigurasi
//Membuat Halaman 

$jumlahdataperhalaman =3;
$jumlahdata = count(helmi("SELECT * FROM tabel_mahasiswa"));
// $jumlahhalaman = round($jumlahdata / $jumlahdataperhalaman); 
// $jumlahhalaman = floor($jumlahdata / $jumlahdataperhalaman); 
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman); 
$halamanaktif = (isset($_GET["halaman"]) )? $_GET["halaman"] : 1;
// if (isset($_GET["halaman"])){
// 	$halamanaktif =$_GET["halaman"];
// 	}else{

// 		$halamanaktif =1;
// 	}

$awaldata = ($jumlahdataperhalaman * $halamanaktif )- $jumlahdataperhalaman;
$mahasiswa = helmi("SELECT * FROM tabel_mahasiswa LIMIT $awaldata ,$jumlahdataperhalaman" );  
//$mahasiswa = helmi("SELECT * FROM tabel_mahasiswa" );

 if(isset($_POST["cari"]) ){
 	$mahasiswa = cari($_POST["keyword"]);
  }


 ?>


 
<!DOCTYPE html>
<html>
	<head>
		<title> HALAMAN ADMIN  </title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
		<link rel="stylesheet" type="text/css" href="tbl.css">
		<link rel="stylesheet" type="text/css" href="id.css">
		<script type="text/javascript" src ="js/bootstrap.min.css"></script>			
	</head>
	<body class="bodytabel">
	<tr>
	            <div class="Id-user">
	            		<label>USER ID</label>
						<input  type="text" name="user" id="ser" disabled required value="<?php  echo  $u_user; ?>">
				</div>
					<br>
		<form method="post">
				<div class="bt-keluar">
						<button  class="btn btn-danger" type="submit" name="lgt">LOGOUT</button>
				</div>
					
					<br>

	             <div class="tmb-mhs">
		               <a href="tambah.php" class="btn btn-primary" >Tambah Mahasiswa </a>
						<br>
						<br>
				</div>
				<div class="pencarian">
						<input type="text" name="keyword" size="35" autofocus=""
						 placeholder="Masukan nama pencarianan" autocomplete="off">
						<button class="btn-cari" type="submit" name="cari">Cari!</button>
						<br>
						<br>
				</div>	
		</form>
	</tr>

	

	<form action="" method="POST">
		<div class="jdl-mhs">
		DAFTAR MAHASISWA STIKOM BINANIAGA BOGOR
		</div>
		<table class="content-table">
					<tr>
						<th> NO.</th>
						<th width="10px"> NPM.</th>
						<th>GAMBAR</th>
						<th width="130px" >NAMA</th>
						<th width="160px">JURUSAN</th>
						<th  width="300px" >ALAMAT</th>
						<th>TELEPON</th>
						<th>REAKSI</th>
					</tr>
						<?php $i = 1; ?>
							
				<?php  foreach ($mahasiswa as $rows ):?>
						<tr>
								<td> <?php echo $i ?></td>
								<td><?php echo $rows["npm"] ?></td>
								<td><img src="BBB/<?php echo $rows["gambar"]; ?>" width="70" ></td>
								<td><?php echo $rows["nama"]; ?></td>
								<td><?php echo $rows["jurusan"]; ?></td>
								<td><?php echo $rows["alamat"] ?></td>
								<td><?php echo $rows["telepon"] ?></td>
								<td>
									<a href="ubah.php?id=<?= $rows["npm"]; ?>" class="btn btn-warning" >Update</a>
									<br>
									<br>
									<a href="hapus.php?id=<?= $rows["npm"]; ?>" class="btn btn-danger" >Delete</a>		
								</td>
								
						</tr>
					
					<?php $i++; ?> 
			<?php endforeach ?>
		</table>
	</form>
	<?php if ($halamanaktif > 1) { ?>
	<table align="center">
	<tr>
		<th>
			<?php if ($halamanaktif > 1) { ?>
				<table>
						<th>
							<?php if ($halamanaktif > 1) { ?>
							<a href="?halaman= <?= $halamanaktif - 1; ?>"><center>BACK</center></a>
							<?php } ?>
						</th>
				</table>
				<?php } ?>
			<?php } ?>
		</th>
		<br>

	<?php  if ($halamanaktif < $jumlahhalaman) {  ?>			
		<th>	
			<?php if ($halamanaktif < $jumlahhalaman) {  ?>
				<table border="2" align="center">
					<th>
						<?php if ($halamanaktif < $jumlahhalaman) { ?>
						<a href="?halaman= <?= $halamanaktif +  1; ?>"><center>NEXT</center></a>
						<?php } ?>
					</th>
				</table>
				<?php } ?>
			<?php } ?>
		</th>
		</tr>
	</table>

		
	
		

	
	<br>
		

	




</body>
</html>