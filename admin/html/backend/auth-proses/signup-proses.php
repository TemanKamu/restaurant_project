<?php
	require "../Connection.php";
	
	if(isset($_POST['register'])) {
		$data1 = $_POST["no_hp"];
		$data2 = $_POST["email"];

		// Mengecek apakah kedua data sudah ada di dalam tabel
		$stmt = $connect->prepare("SELECT * FROM tb_admin WHERE no_hp = ? OR email = ?");
		$stmt->bindParam(1, $data1);
		$stmt->bindParam(2, $data2);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
		// Kedua data sudah ada di dalam tabel, maka tampilkan pesan kesalahan menggunakan JavaScript
		    session_start();
            $_SESSION['akun'] = "ada";
            header("location: ../sign-up.php");
            exit(); // Menghentikan eksekusi kode setelah pengalihan halaman
		} else {
		// Kedua data belum ada di dalam tabel, maka lanjutkan dengan proses selanjutnya
		// ...
			$nomor = $_POST['no_hp'];
            $email = $_POST["email"];
			//password_hash digunakan untuk mengenkripsi
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $status = "Pending";

			$query = "INSERT INTO tb_admin(no_hp,email,password,status) VALUES(?, ?, ?, ?)";
			$data = $connect->prepare($query);

			$data->bindParam(1,$nomor);
			$data->bindParam(2,$email);
			$data->bindParam(3,$password);
            $data->bindParam(4,$status);
			$succes = $data->execute();

			if($succes){
				header("location: ../login.php");
			}else{
				alert("Registerasi gagal");
				header ("../login.php");
			}
		}
		
	}
?>