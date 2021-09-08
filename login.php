 <?php 

session_start();
require 'funcations.php'; 

	{
	     if(isset($_COOKIE["user"]))
	        {
			setcookie("user","");
	       	}
	  		if(isset($_COOKIE["pas"]))
       		{
       		setcookie("pas","");
	        }
	    }
	    		

//Mengembalikan url Yang sudah ada 
 if (isset($_SESSION["nama"])){
 	header("Location: Latihan1.php");
 	exit;
 }

//cek tombol sudah di tekan atau belum
if (isset ($_POST["login"])  ) 
{


	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$status = "1";
	$lgn ="1";
	$err = "";


      

		//cek username apakah sama dengan yang di inputkan oleh user yang sesuai dengan database
		 $cekuser = mysqli_query($conn,"SELECT id ,username, password, status FROM tabel_user WHERE username ='$username'");

		 //Validasi Password kosong atau salah

		if( isset($_POST['username']) && empty($username) )
		$err = "Maaf Username Harus D isi !";
		else if( isset($_POST['password']) && empty($password) )
		$err = "Maaf Password Harus D isi";
		else if ($password != ['password'])
			$err = "Username /Password Salah";
			

		//untuk  menghilangkan session yang sudah di buat parameter ke latihan1.ph
		$sr = $_SESSION["nama"] = $username;
		//$psr = $_SESSION["paswr"] = $pass;
		
	
	{

		 //klo ketemu, nilainya pasti 1 klo tidak ada maka nilainya pasti 0
		 if (mysqli_num_rows($cekuser) === 1) 
		 { //mysqli_num yaitu untuk menghitung ada berapa baris yang di kembalkan dari select di atas
		 	
		 	//klo ada maka cek passwordnya
		 	$psw = mysqli_fetch_assoc($cekuser);			 
	        if (password_verify($password,$psw["password"] ))
	        { 
	        		//Cek Remembember
	        	if (!empty($_POST["remember"]))
	        	{
	   				//Membuat Remember 
	        		setcookie("user",$_POST["username"],time() + (10 * 365 * 24 * 60 * 60));
	        		//setcookie("pas",$_POST["password"],time() + (10 * 365 * 24 * 60 * 60));
	        		setcookie("pas",hash('sha256',$_POST['password'],time() + (10 * 365 * 24 * 60 * 60) ) );
	        	}
	        

				$sql = "SELECT  status FROM tabel_user WHERE username='$username'";
				$data = mysqli_query($conn, $sql); //or die(mysql_error());
				if( mysqli_num_rows( $data ) > 0)
				{
					$user = mysqli_fetch_array( $data );
					//echo "<br>STATUS $user[status]<br>";
					

					//if( $user['status']), $status )
					//{

					
					$_SESSION['stat'] = $user['status'];
					//echo "<br>$username,$password $user[status]<br>";
					//var_dump($user);die;
						if ($_SESSION['stat'] == 1)
						{
				       	
						$err = "User Sedang Login";
						}else{

							$lg =mysqli_query($conn,"UPDATE  tabel_user SET status = '$lgn' WHERE username='$username'");
						 	$_SESSION['stat'] = $user['username'];
						 	header("Location: latihan1.php");
							exit;


						}

				}

			}
		}
	}
	       
       

}





 ?>


<!DOCTYPE html>
<html>


		<style>
				.tengah{
					position: absolute;margin-top: -100px;margin-left: -200px;left: 50%;top: 50%;width: 400px;height: 250px;background-color: blue;
					}
	</style>
	<head>
		<title> Halaman Login</title>
	</head>
	<link rel="stylesheet" type="text/css" href="">

	<body>

		<div align="center" class="tengah"><p align="center"><font face="verdana" size="4" color="white">
		<h1 align="center" with> HALAMAN LOGIN</h1>
		
	<form  action="" method="POST">
				<ul>

				<li>
					<label for="username"> Username : </label>
		<input type="text-align:center" name="username" id = "username" value="<?php if (isset($_COOKIE["user"])) echo $_COOKIE["user"]; ?>">
				</li>
				<br>
				<li>
					<label for="password"> Passsword : </label>
<input type="password" name="password" id = "password" value="<?php if (isset($_COOKIE["pas"])) echo (password_verify($password,$_COOKIE["pas"] )) ?>">
				</li>
				<br>
				<li>
					<label for="remember"> Remember Me </label>
					<input type="checkbox" name="remember" id = "remember">
					
				</li>
					<li>
						<button type="submit" name="login"> LOGIN </button>
					</li>

			</ul>
			</form>

 
					<?php
					if(isset($err)){
						//untuk Menghilangkan session yang di validasi
					session_destroy();
					?>
					<p style="color: black; font-style: italic;"  ><?=$err?> </p>
					<?php
					}
					?>
		
				
		</div>
		

	</body>
</html>