<?php
	include "connection.php";
	if(isset($_POST["submit"]))
	{
		$falloutdatap = $_POST["falloutdata"];
		$falloutwfmp = $_POST["falloutwfm"];
		$falloutactp = $_POST["falloutact"];
		$provdesignp = $_POST["provdesign"];
		$osscreatedp = $_POST["osscreated"];
		$isiskap = $_POST["isiska"];
		$provissuedp = $_POST["provissued"];

		//GET FRO TABEL RESOURCE
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

		//HITUNG DI ACTION 1
		$action1res = $countrwos+$countactcomp;

		//HITUNG DI ACTION 2
		$opfalloutdata = ($countfalldata*($falloutdatap/100));
		$opfalloutwfm = ($countfallwfm*($falloutwfmp/100));
		$opfalloutact = ($countfallact*($falloutactp/100));
		$action2res = round(($opfalloutdata+$opfalloutwfm+$opfalloutact));

		//HITUNG DI ACTION 3
		$opprovdesign = ($countprovdesign*($provdesignp/100));
		$oposscreated = ($countosscreated*($osscreatedp/100));
		$opisiska = ($countisiska*($isiskap/100));
		$action3res = round(($opprovdesign+$oposscreated+$opisiska));

		//HITUNG DI ACTION 4
		$opprovissued = ($countprovissued*($provissuedp/100));
		$action4res = round($opprovissued);

		//PREDIKSI
		$prediksi = $action1res+$action2res+$action3res+$action4res;

		mysqli_query($con,"delete from kalkulasi");
		$query_res = "INSERT INTO kalkulasi (persenfalldata, persenfallwfm, persenfallact, persenprovdesign, persenosscreated, persenisiska, persenprovissued, action1, action2, action3, action4, prediksi) VALUES ('$falloutdatap','$falloutwfmp','$falloutactp','$provdesignp','$osscreatedp','$isiskap','$provissuedp','$action1res','$action2res','$action3res','$action4res','$prediksi')";
		$sql = mysqli_query($con,$query_res) or die (mysqli_error($con));
		header("location: index.php");
	}
		
?>
