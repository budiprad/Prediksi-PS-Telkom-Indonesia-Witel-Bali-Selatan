<?php 
	include "connection.php";

	$tgl_reg = $_POST["tgl"];
	$ncli = $_POST["ncli"];

	if(!empty($tgl_reg) && !empty($ncli)){
		// echo $tgl_reg." ::: ".$ncli;
		$sql_query = "SELECT kendala FROM data_ms2n WHERE DATE(tanggal_reg) = '$tgl_reg' and ncli = '$ncli'";
		$res = mysqli_query($con,$sql_query);
		echo "Ncli : ".$ncli."</br>";
		while($row = mysqli_fetch_array($res)){
			echo "</br>".$row["kendala"]."</br>";
		}
	}

	
 ?>