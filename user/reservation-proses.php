<?php
	require "../Connection.php";
	$id = $_POST['id_pengguna'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$status = "Pending";
	$meja = $_POST['meja'];
	$event = $_POST['event'];
	$request = $_POST['special-request'];


		// Section reservasi
			$query = "INSERT INTO tb_reservasi(id_pengguna,date,time,meja,event,status,request) VALUES(?, ?, ?, ?, ?, ?, ?)";
			$data = $connect->prepare($query);

			$data->bindParam(1,$id);
			$data->bindParam(2,$date);
			$data->bindParam(3,$time);
            $data->bindParam(4,$meja);
            $data->bindParam(5,$event);
            $data->bindParam(6,$status);
			$data->bindParam(7,$request);

			$succes = $data->execute();
			if($succes){
				header("location: index.php");
			}else{
				alert("Registerasi gagal");
				header ("index.php");
			}
?>