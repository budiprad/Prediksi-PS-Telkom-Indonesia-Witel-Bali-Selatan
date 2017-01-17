<?php
	include "connection.php";

	if(isset($_POST["submit"]))
	{
		mysqli_query($con,"delete from backup_data_order");
		mysqli_query($con,"delete from data_order");

		$file = $_FILES['fileorder']['tmp_name'];
		$handle = fopen($file, "r");
		$filesop = fgetcsv($handle, 100000);
		while(($filesop = fgetcsv($handle, 100000)) && $filesop[0])
		{
			if (isset($filesop[9])) {
			
			//get data from .csv
			$no_sc = $filesop[0];
			
			// define date format
			$formatFromFile = 'd-m-Y H:i:s'; // your format of date in csv file

			//ambil tanggal order
			$dt=str_replace("/","-",$filesop[1]);
			$dt = strtotime($dt);
			$dot = date("d-m-Y H:i:s", $dt);
			$date = DateTime::createFromFormat($formatFromFile, $dot);
			$tgl_order = mysqli_real_escape_string($con, $date->format('Y-m-d H:i:s'));

			//ambil tanggal ps
			if ($filesop[2] != ''){
				$dt=str_replace("/","-",$filesop[2]);
				$dt = strtotime($dt);
				$date = DateTime::createFromFormat($formatFromFile, $dot);
				$tgl_ps = mysqli_real_escape_string($con, $date->format('Y-m-d H:i:s'));
			} else {
				$tgl_ps = null;
			}

			$no_order = $filesop[3];
			$ncli = $filesop[4];
			$nama = $filesop[5];
			$nama = mysqli_real_escape_string($con, $nama);
			$alamat = $filesop[6];
			$ndem_internet = $filesop[7];
			$ndem_voice = $filesop[8];
			$status = $filesop[9];
			$nama_alpro = $filesop[11];
			$witel = $filesop[12];
			$kontak = mysqli_real_escape_string($con, $filesop[13]);
			$user_id = $filesop[14];
			$tipe_trx = $filesop[15];
			$tipe = $filesop[16];
			$sto = $filesop[17];

			$sql = mysqli_query($con,"insert into data_order (no_sc, tanggal_order, tanggal_ps, no_order, ncli, nama_customer, alamat_instalasi, ndem_internet, ndem_voice, status, nama_alpro, witel, k_kontak, user_id, tipe_transaksi, tipe, sto ) VALUES ('$no_sc','$tgl_order','$tgl_ps','$no_order','$ncli','$nama','$alamat','$ndem_internet','$ndem_voice','$status','$nama_alpro','$witel','$kontak','$user_id','$tipe_trx','$tipe','$sto')") or die (mysqli_error($con));

			}
		}
		//-------- END DATA ORDER INPUT ---------


		// //-------- START DATA MS2N INPUT ---------
		mysqli_query($con,"delete from data_ms2n");
		$file = $_FILES['filems2n']['tmp_name'];
		$handle = fopen($file, "r");
		$filesop = fgetcsv($handle, 10000);
		while(($filesop = fgetcsv($handle, 10000)) !== false)
		{
			$no = $filesop[0];
			$ncli = $filesop[4];
			$nama = $filesop[18];
			$nama = mysqli_real_escape_string($con, $nama);
			$kendala = mysqli_real_escape_string($con, $filesop[27]);
			$tglreg = $filesop[15];
			$tglreg = strtotime($tglreg);
			$tglreg = date('Y-m-d H:i:s', $tglreg);
			$tglreg = mysqli_real_escape_string($con, $tglreg);
			$sql = mysqli_query($con,"insert into data_ms2n (nomor, ncli, nama_customer, kendala, tanggal_reg) VALUES ('$no','$ncli','$nama','$kendala','$tglreg')") or die (mysqli_error($con));
		}
		// //-------- END DATA MS2N INPUT ---------

		//------------------ FILTER 1 ---------------
		$sql_query = "delete from data_order where status = 'Completed (PS)' or status = 'Cancel Order' or status = 'CANCEL COMPLETED' or status = 'UN-SCC'";
		$sql = mysqli_query($con,$sql_query) or die (mysqli_error($con));


		//-------------- FILTER 2 -------------------
		$sql_query = "DELETE FROM data_order WHERE (ncli) IN ( SELECT ncli FROM data_ms2n where kendala <> '-')";
		$sql = mysqli_query($con,$sql_query) or die (mysqli_error($con));

				//-------------- COUNT DATA -----------------
		$result = mysqli_query($con,"select count(ncli) as juml from data_order") or die (mysqli_error($con));
		$_countTot =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Process ISISKA (RWOS)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countrwos =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Process OSS (Activation Completed)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countoss =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Fallout (Data)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countfalloutdata =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Fallout (WFM)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countfalloutwfm =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Fallout (Activation)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countfalloutact =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Process OSS (Provision Designed)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countprovdesign =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Process OSS (Created)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countosscreated =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Process ISISKA (VA)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countisiska =  $result->fetch_object()->juml;

		$sql_query = "SELECT count(ncli) as juml from data_order where status='Process OSS (Provision Issued)'";
		$result = mysqli_query($con,$sql_query) or die (mysqli_error($con));
		$countprovissued =  $result->fetch_object()->juml;

		$oDate = new DateTime();
		$strdate = strtotime($oDate->format("m/d/Y"));
		$strdate = date("j F Y", $strdate);

		mysqli_query($con,"delete from resource");
		$query_res = "INSERT INTO resource (countrwos, countactcomp, countfalldata, countfallwfm, countfallact, countprovdesign, countosscreated, countisiska, countprovissued, tanggal_prediksi) VALUES ('$countrwos','$countoss','$countfalloutdata','$countfalloutwfm','$countfalloutact','$countprovdesign','$countosscreated','$countisiska','$countprovissued','$strdate')";
		$sql = mysqli_query($con,$query_res) or die (mysqli_error($con));


		
		header("location: form.php");
	}
		
?>
