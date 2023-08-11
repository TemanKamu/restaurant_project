
<?php
	require "../Connection.php";
    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
       // Query Hapus
		$query = "DELETE FROM tb_kritik WHERE id_kritik=?";
		$data = $connect->prepare($query);

		$data->bindParam(1,$id);
		$berhasil = $data->execute();

		if($berhasil){
			header("Location: index.php");
		}else{
			echo "Gagal di hapus";
		}
    }
	
?>