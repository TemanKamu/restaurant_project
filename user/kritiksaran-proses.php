<?php
require "../Connection.php";
    if(isset($_POST["kirim"])){
    
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $kritik = $_POST["message"];
        
        $query = "INSERT INTO tb_kritik(date,time,komplen) VALUES(?,?,?)";
        
        $data = $connect->prepare($query);

        $data->bindParam(1,$date);
        $data->bindParam(2,$time);
        $data->bindParam(3 ,$kritik);

        $succes = $data->execute();
			if($succes){
				header("location: index.php");
			}else{
				alert("Kritik gagal");
				header ("index.php");
			}
    }
?>