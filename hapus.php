<?php 
 session_start();
 
 if (!isset($_SESSION["nama"])){
 	header("Location: login.php");
 exit;
 }

require 'funcations.php';

//kenapa id karna menamakan id setelah mengirim data kelokasi hapus.php yang ada dilokakasi latihan1.php
//<a href="hapus.php?id=<?= $rows["npm"]; 

$id = $_GET["id"];

if (hapus ($id) > 0){
 echo "
		 <script>
		     alert('data berhasil di hapus!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
      }else{

		echo "
		 <script>
		     alert('data gagal di hapus!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";


}





 ?>