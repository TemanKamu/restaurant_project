<?php
	require '../Connection.php';
	if(isset($_POST['barang-simpan'])){
		// Menambah data ke database
        $query1 = "SELECT * FROM tb_pengguna";
        // Hubungkan query di atas ke koneksi menggunakan function prepare()
        $data = $connect->prepare($query);
        // Eksekusi Query menggunakan function execute()
        $data->execute();
        // Ubah data kedalam bentuk object
        $tampil = $data->fetchAll(PDO::FETCH_OBJ);
		$query = "INSERT INTO tb_reservasi(barang_nama, barang_harga,barang_stok) VALUES(?,?,?)";
		// Hubungkan query ke koneksi prepare();
		$data = $connect->prepare($query);

		// Masukkan data yang dari input ke dalam query
		// Menggunakan function bindParam();
		$data->bindParam(1,$_POST['barang-nama']);
		$data->bindParam(2,$_POST['barang-harga']);
		$data->bindParam(3,$_POST['barang-stok']);

		// Query di eksekusi
		$berhasil = $data->execute();

		// Kalau Datanya berhasil disimpan ke database
		if($berhasil){
			// Kembalikan ke halaman index
			header("Location: index.php");
		}else{
			// Jika Data gagal disimpan
			echo "Data Gagal Disimpan";
		}

	}
?>