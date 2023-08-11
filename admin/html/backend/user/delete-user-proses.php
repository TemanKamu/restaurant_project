
<?php
	require "../Connection.php";
    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
       // Query Hapus
		$query = "DELETE FROM tb_pengguna WHERE id=?";
		$data = $connect->prepare($query);

		$data->bindParam(1,$id);
		$berhasil = $data->execute();

		if($berhasil){
			header("Location: user.php");
		}else{
			echo "Gagal di hapus";
		}
    }
	
?>