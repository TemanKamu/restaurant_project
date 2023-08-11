<?php
    require '../Connection.php';
	if(isset($_POST['simpan'])){
		// Menambah data ke database 
        $namaFoto = @$_POST['foto_menu'];
        $tmpFoto = @$_FILES['foto_menu']['tmp_name'];
        $tempat_foto =	'img/'.time().'.png';

		$query = "INSERT INTO tb_menu(nama, deskripsi, price, filter, picture) VALUES(?,?,?,?,?)";
		// Hubungkan query ke koneksi prepare();
		$data = $connect->prepare($query);
       
		// Masukkan data yang dari input ke dalam query
		// Menggunakan function bindParam();
		$data->bindParam(1,$_POST['nama_menu']);
        $data->bindParam(2,$_POST['deskripsi_menu']);
		$data->bindParam(3,$_POST['harga_menu']);
		$data->bindParam(4,$_POST['filter_menu']);
		$data->bindParam(5,$tempat_foto);

		// Query di eksekusi
		$berhasil = $data->execute();

		// Kalau Datanya berhasil disimpan ke database
		if($berhasil){
            copy($tmpFoto,$tempat_foto);
			// Kembalikan ke halaman index
			header("Location: menu.php");
		}else{
			// Jika Data gagal disimpan
			echo "Data Gagal Disimpan";
		}

	}
?>