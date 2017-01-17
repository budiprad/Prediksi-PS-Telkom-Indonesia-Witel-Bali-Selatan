<?php 
include "connection.php";

$search = $_POST["search"];
$selector = $_POST["selection"];
$output = "";

if(!empty($search) && !empty($selector)){
	$query_search = "SELECT no_sc, DATE(tanggal_order) as tgl, ncli, nama_customer, alamat_instalasi, status, sto FROM backup_data_order WHERE ".$selector." LIKE '%".$search."%'";
	$res = mysqli_query($con,$query_search);
	$numres = mysqli_num_rows($res);
	if($numres == 0) {
		echo '<h3 class="text-center">Data Not Found</h3>';  
	} else {
		$output .= '<h4 align="center">Search Result</h4>';  
		$output .= '<div class="table-responsive">  
		<table class="table table-responsive table-bordered">  
			<tr class="active"><th>No SC</th><th>Tanggal</th><th>Ncli</th><th>Nama Customer</th><th>Alamat Instalasi</th><th>Status</th><th>STO</th></tr>';  
		while($row = mysqli_fetch_array($res)) {
			$output .= '  
                <tr>  
                     <td>'.$row["no_sc"].'</td>  
                     <td>'.$row["tgl"].'</td>  
                     <td>'.$row["ncli"].'</td>  
                     <td>'.$row["nama_customer"].'</td>  
                     <td>'.$row["alamat_instalasi"].'</td>  
                     <td>'.$row["status"].'</td>  
                     <td>'.$row["sto"].'</td>  
                </tr>  
           ';  
		}
		echo $output; 
	}

}

 ?>