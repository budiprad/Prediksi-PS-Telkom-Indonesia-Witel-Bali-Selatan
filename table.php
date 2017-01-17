<?php 
	include "connection.php";
	$query1 = "SELECT * FROM backup_data_order";
	$query2 = "SELECT * FROM data_ms2n";
	$result1 = mysqli_query($con,$query1);
	$result2 = mysqli_query($con,$query2);

	$num1 = mysqli_num_rows($result1);
	$num2 = mysqli_num_rows($result2);

	if(( $num1 == 0) || ($num2 == 0)){
		header("location: mainupload.php");
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Harian Telkom Witel Bali Selatan</title>
	<link href="css/bootstraptable.css" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">Telkom Witel Bali Selatan</a>
			</div>
			    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li><a href="mainupload.php">Upload Data</a></li>
      	<li><a href="form.php">Persentase</a></li>
      	<li><a href="index.php">Prediksi PS</a></li>
        <li class="active"><a href="table.php?page=1">Data Harian<span class="sr-only">(current)</span></a></li>
        <li><a href="search.php">Search</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<div class="container-fluid">
		<h1 class="text-center">Data Harian Telkom Witel Bali Selatan</h1>
		<div class="row">
			<div class="col-xs-12 col-md-12">
			<div class="table-responsive">
				<table class ="table table-bordered">
					<tr class="active"><th>Tanggal</th><th>PS</th><th>Cancel</th><th>Proses Cancel</th><th>UN-SCC</th><th>Fallout Data</th><th>Fallout ACT</th><th>Fallout WFM</th><th>Prov Design</th><th>OSS Created</th><th>I-Siska</th><th>PI</th><th>Total</th></tr>
					<?php
					include "connection.php";
					$per_page = 14;
					$query_select = "SELECT DATE(backup_data_order.tanggal_order) FROM backup_data_order GROUP BY DATE(backup_data_order.tanggal_order)";
					$result_select = mysqli_query($con, $query_select);
					$count = mysqli_num_rows($result_select);
					$count = ceil($count/$per_page);

					if(isset($_GET['page'])) {
						$page = $_GET['page'];
						if($page < 1){
							header("location: table.php?page=1");
						} else if ($page > $count){
							header("location: table.php?page=".$count);
						} 
					} else {
						$page = 1;
					}

					if($page == "" || $page == 1){
						$page_start = 0;
					} else {
						$page_start = ($page*$per_page) - $per_page;
					}


					$query = "SELECT count(no_sc) as jml,DATE(tanggal_order) as tgl FROM backup_data_order GROUP BY DATE(backup_data_order.tanggal_order) DESC LIMIT $page_start, $per_page";
					$result = mysqli_query($con,$query);

					while($row = mysqli_fetch_array($result)){
						$querydate = $row["tgl"];
						$date = strtotime($row["tgl"]);
						$tgl = date("j F Y", $date);
						$total = $row["jml"];
						$url = "showdata.php?date=".$date."&page=1";
						echo "<tr><td><a href=".$url.">".$tgl."</a></td>";

						//print status PS
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Completed (PS)'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countPS = $result_count->fetch_object()->jml;
						echo "<td>".$countPS."</td>";

						// //print status Cancel completed
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='CANCEL COMPLETED'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countCancelComp = $result_count->fetch_object()->jml;
						echo "<td>".$countCancelComp."</td>";

						// //print status Proses Cancel
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Cancel Order'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countProsCancel = $result_count->fetch_object()->jml;
						echo "<td>".$countProsCancel."</td>";

						// //print status unscc
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='UN-SCC'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countUNSCC = $result_count->fetch_object()->jml;
						echo "<td>".$countUNSCC."</td>";

						// //print status fallout data
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Fallout (Data)'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countfalldata = $result_count->fetch_object()->jml;
						echo "<td>".$countfalldata."</td>";

						// //print status fallout act
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Fallout (Activation)'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countfallact = $result_count->fetch_object()->jml;
						echo "<td>".$countfallact."</td>";

						// //print status fallout wfm
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Fallout (WFM)'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countfallwfm = $result_count->fetch_object()->jml;
						echo "<td>".$countfallwfm."</td>";

						// //print status prov design
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Process OSS (Provision Designed)'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countprovdesign = $result_count->fetch_object()->jml;
						echo "<td>".$countprovdesign."</td>";

						// //print status oss created
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Process OSS (Created)'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countoss = $result_count->fetch_object()->jml;
						echo "<td>".$countoss."</td>";

						// //print status isiska
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and (status ='Process ISISKA (VA)' or status = 'Process ISISKA')";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countsiska = $result_count->fetch_object()->jml;
						echo "<td>".$countsiska."</td>";

						// //print status PI
						$query_count = "SELECT count(no_sc) as jml FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".mysqli_real_escape_string($con,$querydate)."' and status ='Process OSS (Provision Issued)'";
						$result_count = mysqli_query($con,$query_count) or die (mysqli_error($con));
						$countpi = $result_count->fetch_object()->jml;
						echo "<td>".$countpi."</td>";

						echo "<td>".$total."</td></tr>";
					}

					?>
				</table>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-12 text-center">
			<nav>
			<ul class="pagination ">
				<?php 
					if($page ==1){
						$prev = '<li class="disabled"><span aria-hidden="true">&laquo;</span></li>';
					} else {
						$prev = '<li><a href="table.php?page='.($page-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
					}
					
					if($page == $count){
						$next = '<li class="disabled"><span aria-hidden="true">&raquo;</span></li>';
					} else {
						$next = '<li><a href="table.php?page='.($page+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
					}
				?>
				<?php echo $prev;?>
				<?php 
					for($i=1; $i <= $count; $i++){
						if($i == $page){
							echo "<li class='active'><a href='table.php?page={$i}'>{$i}</a></li>";
						} else {
							echo "<li><a href='table.php?page={$i}'>{$i}</a></li>";
						}

				}
				?>
				<?php echo $next;?>
				</ul>
			</nav>
			</div>
		</div>


	</div>

	<footer>
		<nav class="navbar navbar-default navbar-fixed-bottom">
			<div class="container">
			<h5 class="footer-text text-center">Telkom Witel Bali Selatan by Putu Eka Budi Pradnyana</h5>
			</div>
		</nav>
	</footer>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>