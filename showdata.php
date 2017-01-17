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

	if(!isset($_GET['date']) || !isset($_GET['page'])) {
		header("location: table.php");
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Harian Telkom Witel Bali Selatan</title>
	<link href="css/bootstraptable.css" rel="stylesheet">

</head>
<body>

		<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Kendala Lapangan</h4>
				</div>
				<div class="modal-body">
					<h5 class="modal-text"> </h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<?php 
	if(isset($_GET['date'])){
		$date = $_GET['date'];
		$date = date("j F Y", $date);
	} ?>

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
		<h1 class="text-center">Data Telkom Witel Bali Selatan, <?php echo $date; ?></h1>
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div class="table-responsive">
					<table class ="table table-responsive table-bordered">
					<tr class="active"><th>No SC</th><th>Tanggal</th><th>Ncli</th><th>Nama Customer</th><th>Alamat Instalasi</th><th>Status</th><th>STO</th></tr>
						<?php 
						include "connection.php";
						$count =0;
						$page =0;
						$dateurl = 0;
						if(isset($_GET['date'])){
							$dateurl = $_GET['date'];
							$date = date('Y-m-d',$dateurl);
							$per_page = 15;
							$query_select = "SELECT no_sc FROM backup_data_order WHERE DATE(backup_data_order.tanggal_order) = '".$date."'";
							$result_select = mysqli_query($con, $query_select);
							$count = mysqli_num_rows($result_select);
							$count = ceil($count/$per_page);
							if(isset($_GET['page'])) {
								$page = $_GET['page'];
								if($page < 1){
									$page = 1;
								} else if ($page > $count){
									$page = $count;
								} 
							} else {
								$page = 1;
							}

							if($page == "" || $page == 1){
								$page_start = 0;
							} else {
								$page_start = ($page*$per_page) - $per_page;
							}


							
							$query = "SELECT no_sc, DATE(tanggal_order) as tgl, ncli, nama_customer, alamat_instalasi, status, sto FROM backup_data_order WHERE DATE(tanggal_order) = '".$date."' ORDER BY backup_data_order.status DESC LIMIT ".$page_start.",".$per_page;
							$result = mysqli_query($con,$query);
							while($row = mysqli_fetch_array($result)){
								$rowtanggal = $row["tgl"];
								$rowncli = $row["ncli"];
								echo "<tr><td>".$row["no_sc"]."</td>";
								echo "<td>".$rowtanggal."</td>";
								echo "<td>".$rowncli."</td>";
								echo "<td>".$row["nama_customer"]."</td>";
								echo "<td>".$row["alamat_instalasi"]."</td>";
								$rowstatus="";
								if($row["status"] == "Process OSS (Provision Issued)"){
									$query_check = "SELECT * from data_ms2n WHERE DATE(tanggal_reg) = '".$rowtanggal."' and ncli = '".$rowncli."' and kendala <> '-'";
									$result_check = mysqli_query($con,$query_check);
									$num_row = mysqli_num_rows($result_check);
									if($num_row == 0){
										$rowstatus = "<td>".$row["status"].'   <span class="glyphicon glyphicon-ok yes" aria-hidden="true"></span></td>';
									} else {
										$rowstatus = "<td><a class='kendala' data-tgl='".$rowtanggal."' data-ncli='".$rowncli."' data-toggle='modal' data-target='#myModal'>".$row["status"].'   <span class="glyphicon glyphicon-remove no" aria-hidden="true"></span></a></td>';
									}
								} else {
									$rowstatus = "<td>".$row["status"]."</td>";
								}
								echo $rowstatus;
								echo "<td>".$row["sto"]."</td></tr>";
							}
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
						$prev = '<li><a href="showdata.php?date='.$dateurl.'&page='.($page-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
					}
					
					if($page == $count){
						$next = '<li class="disabled"><span aria-hidden="true">&raquo;</span></li>';
					} else {
						$next = '<li><a href="showdata.php?date='.$dateurl.'&page='.($page+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
					}
				?>
				<?php echo $prev;?>
				<?php 
					for($i=1; $i <= $count; $i++){
						if($i == $page){
							echo "<li class='active'><a>{$i}</a></li>";
						} else {
							echo '<li><a href="showdata.php?date='.$dateurl.'&page='.$i.'" >'.$i.'</a></li>';
						}

				}
				?>
				<?php echo $next;?>
				</ul>
			</nav>
			</div>
		</div>
	</div>
	<footer class="footer">
	<nav class="navbar navbar-default navbar-fixed-bottom">
			<div class="container">
			<h5 class="footer-text text-center">Telkom Witel Bali Selatan by Putu Eka Budi Pradnyana</h5>
			</div>
			</nav>
	</footer>



	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function(){
			$('.kendala').on('click',function(){
				var tgl =  $(this).data("tgl");
				var ncli =  $(this).data("ncli");

				// start AJAX
				$.ajax({
					url:'getkendala.php',
					data: {tgl:tgl, 
							ncli:ncli},
					type: 'POST',
					success: function(data){

						if(!data.error){
							$('.modal-text').html(data);
						}
					}
				});

			});
		});
		

	</script>

</body>
</html>