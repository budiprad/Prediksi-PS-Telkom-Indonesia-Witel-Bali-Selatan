<!DOCTYPE html>
<html>
<head>
	<title>Prediksi Telkom</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>

		function selectStep(n){
			if(n == 1) {
				var fileName = $("#fileUploader1").val();
				if(fileName === '') {
					alert("Upload file order (.csv) terlebih dahulu.");
				} else {
					$(".content-switcher").hide();
					$("#back").show();
					$("#content2").show();
				}

			} else if (n == 2) {
				$(".content-switcher").hide();
				$("#content1").show();
				$("#back").hide();
			}  			
		}

		function validateExt(file,n) {
			var ext = file.split(".");
			ext = ext[ext.length-1].toLowerCase();      
			var arrayExtensions = ["csv"];

			if (arrayExtensions.lastIndexOf(ext) == -1) {
				alert("File yang diupload harus .csv");
				$("#fileUploader"+n).val("");
			}
		}

		function validateFile(){
   				var fileName = $("#fileUploader2").val();
    			if (fileName  === '') {
        				alert("Upload file ms2n (.csv) terlebih dahulu.");
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
					<li class="active"><a href="mainupload.php">Upload Data<span class="sr-only">(current)</span></a></li>
					<li><a href="form.php">Persentase</a></li>
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
			<div class="logo"><img src="images/logo.png"></div>
			<div class = "content">
				<form enctype="multipart/form-data" action="uploadfile.php" method="post" onsubmit="return validateFile();">
					<div class="content-switcher" id="content1">	
						<label class="text-upl"> Upload file StarClick (.csv) : </label>
						<div class="unit">
							<input id="fileUploader1" type="file" name="fileorder" onChange="validateExt(this.value, 1)"/>	
						</div>
						<div class = "inline-btn-next">
							<button id = "next" type="button" class="btn-primary" onclick="selectStep(1); return false;">Next</button>
						</div>
					</div>

					<div class="content-switcher" id="content2">

						<div class="text-upl"> Upload file MS2N (.csv) : </div>
						<div class="unit">
							<input id="fileUploader2" type="file" name="filems2n" onChange="validateExt(this.value, 2)"/>	
						</div>
						<div class = "inline-btn">
							<button id = "back" type="button" class="btn-primary" onclick="selectStep(2); return false;">Back</button>
							<input id = "nexts" type="submit" name="submit" value="Submit" class="btn-primary"/>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>

	<div class="footer">
		<h5>&copy; 2016 Geladi Telkom University | Inspired by  <a href="http://w3layouts.com/"> W3layouts</a></h5>
		<h6>re-Created by Putu Eka Budi Pradnyana  </h6>
	</div>
</body>
</html>
