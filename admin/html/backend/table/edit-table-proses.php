<?php
	require "../Connection.php";
	
	
	if(isset($_POST['edit'])) {
			$id = $_POST['id_meja'];
            $noMeja = $_POST["meja_no"];
            $jumlahOrang = $_POST["pax"];
    
			$query = "UPDATE tb_meja SET no=?, jumlah_orang=? WHERE id_meja=?";
			$data = $connect->prepare($query);

			$data->bindParam(1,$noMeja);
			$data->bindParam(2,$jumlahOrang);
			$data->bindParam(3,$id);

			$succes = $data->execute();

			if($succes){
				header("location: table.php");
			}else{
				alert("edit gagal");
				header ("edit-table.php");
			}		
	}
?>