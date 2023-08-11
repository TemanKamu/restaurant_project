<?php
	require "../../Connection.php";
	
	
	if(isset($_POST['register'])) {
		$data1 = $_POST["nomor"];
		$data2 = $_POST["email"];

		// Mengecek apakah kedua data sudah ada di dalam tabel
		$stmt = $connect->prepare("SELECT * FROM tb_pengguna WHERE no_telp = ? OR email = ?");
		$stmt->bindParam(1, $data1);
		$stmt->bindParam(2, $data2);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
		// Kedua data sudah ada di dalam tabel, maka tampilkan pesan kesalahan menggunakan JavaScript
			session_start();
			$_SESSION['status'] = "ada";
				header("location: login.php#signup");
				exit(); // Menghentikan eksekusi kode setelah pengalihan halaman
			} else {
			// Kedua data belum ada di dalam tabel, maka lanjutkan dengan proses selanjutnya
		// ...
			$nama = $_POST['nama'];
			$email = $_POST['email'];
			$nomor = $_POST['nomor'];
			//password_hash digunakan untuk mengenkripsi
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$query = "INSERT INTO tb_pengguna(nama,email,password,no_telp) VALUES(?, ?, ?, ?)";
			$data = $connect->prepare($query);

			$data->bindParam(1,$nama);
			$data->bindParam(2,$email);
			$data->bindParam(3,$password);
			$data->bindParam(4,$nomor);

			$succes = $data->execute();

			if($succes){
				header("location: ../index.php");
			}else{
				alert("Registerasi gagal");
				header ("login.html");
			}
		}
		
	}
?>