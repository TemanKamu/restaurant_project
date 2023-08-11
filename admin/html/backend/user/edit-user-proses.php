<?php
	require "../Connection.php";
	
	
	if(isset($_POST['edit'])) {
			$id = $_POST['id_pengguna'];
            $nama = $_POST["nama"];
            $email = $_POST["email"];
            $newPassword = $_POST['password'];
            $nomor = $_POST["nomor_telp"];

            // Hash the new password
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

			$query = "UPDATE tb_pengguna SET nama=?, email=?, password=?, no_telp=? WHERE id=?";
			$data = $connect->prepare($query);

			$data->bindParam(1,$nama);
			$data->bindParam(2,$email);
			$data->bindParam(3,$newPasswordHash);
			$data->bindParam(4,$nomor);
			$data->bindParam(5,$id);

			$succes = $data->execute();

			if($succes){
				header("location: user.php");
			}else{
				alert("Registerasi gagal");
				header ("user.php");
			}		
	}
?>