<?php
	require "../Connection.php";
	
	
	if(isset($_POST['add_table'])) {
            $noMeja = $_POST["meja_no"];
            $status = $_POST["status"];
            $jumlahOrang = $_POST["pax"];

			$query = "INSERT INTO tb_meja(no,status,jumlah_orang) VALUES(?, ?, ?)";
			$data = $connect->prepare($query);

			$data->bindParam(1,$noMeja);
			$data->bindParam(2,$status);
			$data->bindParam(3,$jumlahOrang);

			$succes = $data->execute();

			if($succes){
				header("location: table.php");
			}else{
				alert("Registerasi gagal");
				header ("table.php");
			}
		
	}
?>