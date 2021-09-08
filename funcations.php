<?php 

//koneksi ke database
$namahost="Localhost";
$namauser="root";
$namadatabase="phpdasar";
$password="";
 $conn =mysqli_connect($namahost,$namauser,$password,$namadatabase);

function helmi($query){
	//global untuk memanggil variabel di luar funcation
	global $conn;
	$result =mysqli_query($conn,$query);
	//siapin wadah kosong
	$rows=[];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}

 return $rows;
}


function tambah($data){
	global $conn;
	//htmlspecial berfungsi agar supaya inputan atau website akan aman

	$npm = htmlspecialchars( $data["npm"]);
	$nama =htmlspecialchars ($data["nama"]);
   $jurusan =htmlspecialchars ($data["jurusan"]);
	$alamat =htmlspecialchars ($data["alamat"]);
	$telepon =htmlspecialchars ($data["telepon"]);

 


if(ctype_alpha(str_replace(' ', '', $nama)) === false){
         echo "
		 <script>
		     alert('Nama Harus berupa Huruf!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
}elseif(ctype_alpha(str_replace(' ', '', $jurusan)) === false){
         echo "
		 <script>
		     alert('Jurusan Harus Berupa Huruf!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
}elseif(!is_numeric($telepon)){
         echo "
		 <script>
		     alert('Telpon Harus angka!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
	}else{

	// jalankan fungsi upload gambar dulu

	$gambar = upload();

	if (!$gambar){

		return false;
	}






      //$gambar =htmlspecialchars ($data["gambar"]);

	$tmh ="INSERT INTO tabel_mahasiswa
	   values
	   ('$npm ','$nama','$gambar','$jurusan','$alamat','$telepon')";
	   //$conn adalah parameter pertama untuk memanggil koneksinya
	


	mysqli_query($conn,	$tmh);


	return mysqli_affected_rows($conn);
}
}




function upload(){

	$namafile =$_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
 //errror untuk mengetahui ada gambar yang di upload atau tidak
	$eror = $_FILES['gambar']['error'];
	$penyimpananfile =$_FILES['gambar']['tmp_name'];

	if($eror === 4){

		 echo "
		 <script>
		     alert('pilih gambar terlebih dahulu!');
		

		 </script>
		 ";
		 return false;
		}

		//cek apakah yang di upload adalah gambar
		$ektensigambarvalid =['jpg','jpeg','png'];
		$ektensigambar =explode('.', $namafile);
		//jadi yang di ambil adalah jpg nya doang makanhgkanya pake end
		//contoh helmi.jpg
		$ektensigambar = strtolower(end($ektensigambar));
		//strtolower supaya ektensinya di paksa untuk huruf kecil (jpg) 

		if(!in_array($ektensigambar, $ektensigambarvalid)){
			//membuat supaya sesuai dengan ektensinya
			 echo "
		 <script>
		     alert('yang anda upload bukan Gambar!');
		 </script>
		 ";
		 return false;
		 
		}
		
		//cek jika ukuraya terlalu besar

		if ($ukuranfile > 1000000){
				 echo "
		 <script>
		     alert('Ukuran gambar terlalu besar!');
		

		 </script>
		 ";
		 return false;


		}
		$namafile = uniqid(); //untuk merendom nama file supaya tidak sama tidak sama
	    $namafile .= '.';
	    $namafile .=$ektensigambar;


		//lolos pengecekan gambar ,siap upload
		move_uploaded_file($penyimpananfile, 'BBB/'.$namafile);
		return $namafile;




}

function hapus($id){
   global $conn;

   mysqli_query($conn,"DELETE FROM tabel_mahasiswa WHERE npm = $id");
   
   //The mysqli_affected_rows() mengembalikan fungsi jumlah baris yang terkena dampak di SELECT sebelumnya, INSERT, UPDATE, REPLACE, atau DELETE query.
   return mysqli_affected_rows($conn);

}



function ubah($data){

  	global $conn;
	//htmlspecial berfungsi agar supaya inputan atau website akan aman

	$nmp = htmlspecialchars($data["npm"]);
	$nama =htmlspecialchars($data["nama"]);
	$jurusan =htmlspecialchars($data["jurusan"]);
	$alamat =htmlspecialchars ($data["alamat"]);
	$telepon =htmlspecialchars ($data["telepon"]);
	$gambarlama = htmlspecialchars ($data['gambarlama']);
   

if(ctype_alpha(str_replace(' ', '', $nama)) === false){
         echo "
		 <script>
		     alert('Nama Harus berupa Huruf!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
}elseif(ctype_alpha(str_replace(' ', '', $jurusan)) === false){
         echo "
		 <script>
		     alert('Jurusan Harus Berupa Huruf!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
}elseif (!is_numeric($telepon)){
         echo "
		 <script>
		     alert('Telpon Harus angka!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
}elseif(ctype_alpha(str_replace(' ', '', $alamat)) === false){
         echo "
		 <script>
		     alert('Alamat Harus Berupa Huruf!');
		    document.location.href ='latihan1.php';

		 </script>
		 ";
		}else{

    //cek apakah user pilih gambar baru
	if($_FILES['gambar']['error']=== 4){
		$gambar = $gambarlama;
   }else{
		$gambar=upload();
   }if(!$gambar){
     return false;
   }



	$tmh ="UPDATE tabel_mahasiswa SET 
	         npm ='$nmp',
	         nama ='$nama',
	         gambar ='$gambar',
	         jurusan ='$jurusan',
	         alamat ='$alamat',
	         telepon ='$telepon'
	         WHERE npm = '$nmp'
	         ";
	   //$conn adalah parameter pertama untuk memanggil koneksinya

	mysqli_query($conn,	$tmh);

	return mysqli_affected_rows($conn);

}

}




function cari($keyword){

	$query = "SELECT * FROM tabel_mahasiswa 
	       WHERE  
	         npm LIKE '%$keyword%' OR 
	         nama LIKE '%$keyword%' OR 
	       jurusan LIKE '%$keyword%' OR 
	         alamat LIKE '%$keyword%' OR 
	         telepon LIKE'%$keyword%'

	        ";

	        return helmi($query);
}

function registrasi($data){
       global $conn;
       $username = strtolower(stripcslashes($data["Username"]));
       $password = mysqli_real_escape_string($conn,$data["Password"]);
       $password2 = mysqli_real_escape_string($conn,$data["Password2"]);
       $pesanvalidasi = array();

       //cek username sudah ada atau belum

       $cekuser = mysqli_query($conn,"SELECT username FROM tabel_user WHERE username = '$username'");

       if (mysqli_fetch_assoc($cekuser)){
       	  echo "
		 <script>
		     alert('Username Sudah Terdaftar!');
		     </script>";

		     return false;
       }

       //cek konfirmasi password
       if ($password !== $password2){
             $pesanvalidasi[]="Konfirmasi Password Salah Pisan !";
          }if (count($pesanvalidasi) !=0){
			     	foreach ($pesanvalidasi as $pesan ) {
			     	echo "<p><sup></sup>$pesan</p>";
			    
			       return false;


		     	}


     }

       //enkripsi password (mengamankan password)
       //$password = MD5($password);
       //vardump($password); die;
       $password = password_hash($password, PASSWORD_DEFAULT);
    
      //tambahkan ke database
       mysqli_query($conn, "INSERT INTO tabel_user VALUES ('','$username',
       	'$password','')");
       	return mysqli_affected_rows($conn);

}



 ?>

