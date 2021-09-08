<?php

 require 'funcations.php'; 

if (isset($_POST["Register"]) ){



	if( registrasi($_POST) > 0 ){
	  echo "
		 <script>
		     alert('User Baru Behasil ditambahkan!');
		     </script>";
      } else {

		echo mysqli_error($conn);


	}
}

 ?>


<!DOCTYPE html>
<html>

<head>
	<title> Halaham Registrasi </title>
<style >
	label {
		display: block;

	}



</style>

</head>

<body>

	<h1> HALAMAN REGISTRASI </h1>
	<form action="" method="post">
		<ul>
			
	<li>
			<label for="Username"> Username :</label>

			<input type="text" name="Username" id= "Username" required>

		</li>
	<li>
			<label for="Password"> Password :</label>
			
			<input type="Password" name="Password" id= "Password" required>

		</li>
	 <li>
			<label for="Password2"> Konfirmasi Password :</label>
			
			<input type="Password" name="Password2" id= "Password2">

		</li>
		<li>
			
		<button type="submit"  name ="Register"> REGISTRASI</button>

     	</li>
		<br>

		<li>
			<a href="Login.php"> Login </a>

		</li>


		</ul>
	
		


	</form>

</body>
</html>