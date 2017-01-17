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
	} else {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		//GET FRO DB
		$query_res = "SELECT countrwos, countactcomp, countfalldata, countfallwfm, countfallact, countprovdesign, countosscreated, countisiska, countprovissued FROM resource";
		$sql = mysqli_query($con,$query_res) or die (mysqli_error($con));
		while($row = mysqli_fetch_array($sql)){
			$countrwos = $row["countrwos"];
			$countactcomp = $row["countactcomp"];
			$countfalldata = $row["countfalldata"];
			$countfallwfm = $row["countfallwfm"];
			$countfallact = $row["countfallact"];
			$countprovdesign = $row["countprovdesign"];
			$countosscreated = $row["countosscreated"];
			$countprovissued = $row["countprovissued"];
			$countisiska = $row["countisiska"];
		}
		
		
	}
 ?>
<!DOCTYPE html>

<html>
<head>
	<title>Prediksi Telkom</title>
	<link href="css/form.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$('document').ready(function(){
			$('[data-tooltip]').tooltip();
		});

		$(document).ready(function(){
			$("#errormsg1").hide();
			$("#errormsg2").hide();
			$("#errormsg3").hide();
			$('.button').click(function(){
				if ($('#AccountText').val() == ""){
					alert('Please complete the field');
				}
			});
		});

		function selectStep(n){
			if(n == 1) {
				$(".content-switcher").hide();
				$("#back").show();
				$("#content2").show();
				$("#page2").addClass("selected");
				$("#page2").removeClass("notselected");
				$("#page1").addClass("notselected");
				$("#page1").removeClass("selected");	
			} else if (n == 2) {
				$(".content-switcher").hide();
				$("#content1").show();
				$("#page2").addClass("notselected");
				$("#page2").removeClass("selected");
				$("#page1").addClass("selected");
				$("#page1").removeClass("notselected");
			} else if (n == 3){
				var fal1 = $("#falloutdata").val();
				var fal2 = $("#falloutwfm").val();
				var fal3 = $("#falloutact").val();

				if(fal1 == '' || fal2 == '' || fal3 == '') {
					$("#errormsg1").show();
					$(".err-text").html("Masukan persentase terlebih dahulu.");
				} else {
					$(".content-switcher").hide();
					$("#content3").show();
					$("#page2").addClass("notselected");
					$("#page2").removeClass("selected");
					$("#page3").addClass("selected");
					$("#page3").removeClass("notselected");	
				}
								
			} else if (n == 4){
				$(".content-switcher").hide();
				$("#errormsg1").hide();
				$("#back").show();
				$("#content2").show();
				$("#page3").addClass("notselected");
				$("#page3").removeClass("selected");
				$("#page2").addClass("selected");
				$("#page2").removeClass("notselected");					
			} else if (n == 5){
				var prov = $("#provdesign").val();
				var oss = $("#osscreated").val();
				var siska = $("#isiska").val();

				if(prov == '' || oss == '' || siska == '') {
					$("#errormsg2").show();
					$(".err-text2").html("Masukan persentase terlebih dahulu.");
				} else {
					$(".content-switcher").hide();
					$("#back").show();
					$("#content4").show();
					$("#page3").addClass("notselected");
					$("#page3").removeClass("selected");
					$("#page4").addClass("selected");
					$("#page4").removeClass("notselected");		
				}				
			} else if (n == 6){
				$(".content-switcher").hide();
				$("#errormsg2").hide();
				$("#back").show();
				$("#content3").show();
				$("#page4").addClass("notselected");
				$("#page4").removeClass("selected");
				$("#page3").addClass("selected");
				$("#page3").removeClass("notselected");					
			}

		}

		function validateFile(){
   				var pi = $("#provissued").val();
    			if (pi  === '') {
        				$("#errormsg3").show();
						$(".err-text3").html("Masukan persentase terlebih dahulu.");
        				return false;
    			} else {
    				return true;
    			}
		}

	</script>
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
					<li class="active"><a href="form.php">Persentase<span class="sr-only">(current)</span></a></li>
					<li><a href="index.php">Prediksi PS</a></li>
					<li><a href="table.php?page=1">Data Harian</a></li>
					<li><a href="search.php">Search</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<div id="container">
		<h1> Prediksi PS </h1>
		<h2> Telkom Witel Bali Selatan</h2>
		<div id="main">
			<li class="selected" id="page1" onclick="change_tab(this.id);">Action 1</li>
			<li class="notselected" id="page2" onclick="change_tab(this.id);">Action 2</li>
			<li class="notselected" id="page3" onclick="change_tab(this.id);">Action 3</li>
			<li class="notselected" id="page4" onclick="change_tab(this.id);">Action 4</li>
			<div id="page_content">
				<div class="logo"><img src="images/logo.png"></div>
				<div class = "content">
					<form class="form-horizontal" action="kalkulasi.php" method="post" onsubmit="return validateFile();">
						<div class="content-switcher" id="content1">
						<div class="form-group">
								<div class="col-sm-4">	
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-6 control-label">RWOS</label>
								<a id="myTooltip" class="btn btn-default col-sm-2" data-tooltip data-placement="right" title="Banyak data berstatus RWOS"><?php 
									echo $countrwos;
								?></a>
							</div>
							
							<div class="form-group">
								<label class="col-sm-6 control-label">ACT COMP</label>
								<span class="btn btn-default col-sm-2" data-tooltip data-placement="right" title="Banyak data berstatus ACT COMP"><?php 
									echo $countactcomp;
								?></span>
							</div>
							<div class="form-group">
								<div class="col-sm-4">	
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4">	
								</div>
							</div>
							<div class = "inline-btn-next">
								<button id = "next" type="button" class="btn-danger" onclick="selectStep(1); return false;">Next</button>
							</div>
						</div>	



						<div class="content-switcher" id="content2">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">FALLOUT DATA</label>
								
								<div class="col-sm-4">
									<input type="number" class="form-control" id="falloutdata" name="falloutdata" placeholder="% Fallout Data"> 
								</div>
								<a class="btn btn-default col-sm-1" data-tooltip data-placement="right" title="Banyak data berstatus Fallout Data."><?php 
									echo $countfalldata;
								?></a>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">FALLOUT WFM</label>
								
								<div class="col-sm-4">
									<input type="number" class="form-control" id="falloutwfm" name="falloutwfm" placeholder="% Fallout WFM"> 
								</div>
								<span class="btn btn-default col-sm-1" data-tooltip data-placement="right" title="Banyak data berstatus Fallout WFM."><?php 
									echo $countfallwfm;
								?></span>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">FALLOUT ACT</label>
								
								<div class="col-sm-4">
									<input type="number" class="form-control" id="falloutact" name="falloutact" placeholder="% Fallout ACT"> 
								</div>
								<span class="btn btn-default col-sm-1" data-tooltip data-placement="right" title="Banyak data berstatus Fallout ACT."><?php 
									echo $countfallact;
								?></span>
							</div>
							<div id="errormsg1" class="alert alert-danger" role="alert"><h5 class="err-text"></h5></div>
							<div class = "inline-btn-next">
								<button id = "back" type="button" class="btn-danger" onclick="selectStep(2); return false;">Back</button>
								<button id = "next" type="button" class="btn-danger" onclick="selectStep(3); return false;">Next</button>
							</div>
						</div>


						<div class="content-switcher" id="content3">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">PROV DESIGN</label>
								
								<div class="col-sm-4">
									<input type="number" class="form-control" id="provdesign" name="provdesign" placeholder="% Prov Design"> 
								</div>
								<a class="btn btn-default col-sm-1" data-toggle="tooltip" data-tooltip data-placement="right" title="Banyak data berstatus Prov Design."><?php 
									echo $countprovdesign;
								?></a>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">OSS CREATED</label>
								
								<div class="col-sm-4">
									<input type="number" class="form-control" id="osscreated" name="osscreated" placeholder="% OSS Created"> 
								</div>
								<span class="btn btn-default col-sm-1" data-tooltip data-placement="right" title="Banyak data berstatus OSS Created."><?php
									echo $countosscreated;
								?></span>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">I-SISKA (VA)</label>
								
								<div class="col-sm-4">
									<input type="number" class="form-control" id="isiska" name="isiska" placeholder="% I-SISKA (VA)"> 
								</div>
								<span class="btn btn-default col-sm-1" data-tooltip data-placement="right" title="Banyak data berstatus I-SISKA (VA)."><?php 
									echo $countisiska;
								?></span>
							</div>
							<div id="errormsg2" class="alert alert-danger" role="alert"><h5 class="err-text2"></h5></div>
							<div class = "inline-btn-next">
								<button id= "back-act3" type="button" class="btn-danger" onclick="selectStep(4); return false;">Back</button>
								<button id = "next" type="button" class="btn-danger" onclick="selectStep(5); return false;">Next</button>
							</div>
						</div>

						<div class="content-switcher" id="content4">
							<div class="form-group">
								<div class="col-sm-4">	
								</div>
							</div>
							</br>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-5 control-label">PROV ISSUED</label>
								
								<div class="col-sm-4">
									<input type="number" class="form-control" id="provissued" name="provissued" placeholder="% Prov Issued"> 
								</div>
								<a class="btn btn-default col-sm-1" data-tooltip data-placement="right" title="Banyak data berstatus Prov Issued"><?php 
									echo $countprovissued;
								?></a>
							</div>
							<div id="errormsg3" class="alert alert-danger" role="alert"><h5 class="err-text3"></h5></div>
						<div class = "inline-btn-next">
							<button id= "back-act3" type="button" class="btn-danger" onclick="selectStep(6); return false;">Back</button>
							<input id = "next" type="submit" class="btn-danger" name="submit" value="Submit" />
						</div>
					</div>


				</form>
			</div>

		</div>
	</div>
	<div class="footer">
		<h5>&copy; 2016 Geladi Telkom University | Inspired by  <a href="http://w3layouts.com/"> W3layouts</a></h5>
		<h6>  re-Created by Putu Eka Budi Pradnyana  </h6>
	</div>
</div>

</div>
</body>
</html>
