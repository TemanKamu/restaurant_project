<?php
	require '../../Connection.php';

	if(isset($_POST['login'])){
		$dataUser = $_POST['dataUser'];
		$password = $_POST['password'];
        
       
		// Cek email terdaftar ada di database
		$query = "SELECT * FROM tb_pengguna WHERE email = ? OR no_telp = ?";
		$data = $connect->prepare($query);
		$data->bindParam(1, $dataUser);
        $data->bindParam(2, $dataUser);

		$data->execute();
		$user = $data->fetch(PDO::FETCH_OBJ);
        
		if(empty($user)){
            session_start();
            $_SESSION['status'] = "Kosong";
            header("location: login.php");
            exit(); // Menghentikan eksekusi kode setelah pengalihan halaman
        }else{
            //Jika status akun masih pending
                if(password_verify($password, $user->password)){	
                    //Panggil session
                    session_start();
                    // Simpan nama dan email ke dalam session
                    $_SESSION['email'] = $user->email;
                    $_SESSION['no_hp'] = $user->no_telp;
                    $_SESSION['id'] = $user->id;

                    header("location: ../index.php");
                    exit();
                }else{
              
                    session_start();
                    $_SESSION['password'] = "salah";
                    
                    header("location: login.php");
                    exit(); // Menghentikan eksekusi kode setelah pengalihan halaman
                }
            
        }
	}
?>