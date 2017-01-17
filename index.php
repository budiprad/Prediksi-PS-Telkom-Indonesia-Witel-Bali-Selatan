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

        //GET FROm tbel resource
        $query_res = "SELECT tanggal_prediksi, countrwos, countactcomp, countfalldata, countfallwfm, countfallact, countprovdesign, countosscreated, countisiska, countprovissued FROM resource";
        $sql = mysqli_query($con,$query_res) or die (mysqli_error($con));
        while($row = mysqli_fetch_array($sql)){
            $tanggal_prediksi = $row["tanggal_prediksi"];
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

        //GET from tbel kalkulasi
        $query_res = "SELECT persenfalldata, persenfallwfm, persenfallact, persenprovdesign, persenosscreated, persenisiska, persenprovissued, action1, action2, action3, action4, prediksi FROM kalkulasi";
        $sql = mysqli_query($con,$query_res) or die (mysqli_error($con));
        while($row = mysqli_fetch_array($sql)){
            $persenfalldata = $row["persenfalldata"];
            $persenfallwfm = $row["persenfallwfm"];
            $persenfallact = $row["persenfallact"];
            $persenprovdesign = $row["persenprovdesign"];
            $persenosscreated = $row["persenosscreated"];
            $persenisiska = $row["persenisiska"];
            $persenprovissued = $row["persenprovissued"];
            $action1 = $row["action1"];
            $action2 = $row["action2"];
            $action3 = $row["action3"];
            $action4 = $row["action4"];
            $prediksi = $row["prediksi"];

        }


    }


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Prediksi PS Telkom Witel Bali Selatan</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrapmain.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body id="page-top" class="index">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <a class="navbar-brand" href="#page-top">Telkom Witel Bali Selatan</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="table.php?page=1" >Data Harian</a>
                    </li>
                    <li class="page-scroll">
                        <a href="mainupload.php" >Upload Data</a>
                    </li>
                    <li class="page-scroll">
                        <a href="search.php">Search</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    </br>
                    <div class="intro-text">
                        <span class="name">PREDIKSI PS</span>
                        <span class="name"><?php echo $prediksi; ?></span>
                        <hr class="star-light">
                        <span class="skills"><?php echo $tanggal_prediksi; ?></span>
                    </div>
                    </br>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Kalkulasi</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 portfolio-item">
                    <div class="portfolio-link" data-toggle="modal">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                              <h3 class="panel-title"> Action 1  <span class="badge"><?php echo $action1;?></span></h3>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> RWOS </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countrwos;?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> ACT COMP </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countactcomp;?></span>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
             
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <blockquote >
                                      <p class="instruksi"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Mengingatkan korlap untuk pengecekan usage di lokasi.</p>
                                  </blockquote>
                                </div>
                            </div>
                            </br>
                            </div>   
                        </div>  
                    </div>
                </div>
                <div class="col-sm-6 portfolio-item">
                    <div class="portfolio-link" data-toggle="modal">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                              <h3 class="panel-title">Action 2  <span class="badge"><?php echo $action2;?></span></h3>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> Fallout Data </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countfalldata." (".$persenfalldata."%)";?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> Fallout WFM </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countfallwfm." (".$persenfallwfm."%)";?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> Fallout ACT </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countfallact." (".$persenfallact."%)";?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                   
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <blockquote >
                                      <p class="instruksi"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Pengerjaan berdasarkan umur order.</p>
                                      <p class="instruksi"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Pembagian PIC jelas.</p>
                                  </blockquote>
                                </div>
                            </div>
                            </div>   
                        </div>  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 portfolio-item">
                    <div class="portfolio-link" data-toggle="modal">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                              <h3 class="panel-title">Action 3  <span class="badge"><?php echo $action3;?></span></h3>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> Prov Design </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countprovdesign." (".$persenprovdesign."%)";?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> OSS Created </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countosscreated." (".$persenosscreated."%)";?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> I-SISKA (VA) </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countisiska." (".$persenisiska."%)";?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <blockquote >
                                      <p class="instruksi"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Minta dorong ke sigma sesuai dengan umur order.</p>
                                  </blockquote>
                                </div>
                            </div>
                            </div>   
                        </div>  
                    </div>
                </div>
                <div class="col-sm-6 portfolio-item">
                    <div class="portfolio-link" data-toggle="modal">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                              <h3 class="panel-title">Action 4  <span class="badge"><?php echo $action4;?></span></h3>
                          </div>
                          <div class="panel-body">
                          </br>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    <label> Prov Issued </label>
                                </div>
                                <div class="col-sm-2">
                                    <span class="label label-default"><?php echo $countprovissued." (".$persenprovissued."%)";?></span>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-sm-5 col-md-offset-2">
                                    
                                </div>
                                <div class="col-sm-2">
                                    
                                </div>
                            </div>
                            </div>   
                        </div>  
                    </div>
                </div>
            
            </div>
        </div>
    </section>

    

    

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <h5>&copy; 2016 Geladi Telkom University By Putu Eka Budi Pradnyana </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>




    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

</body>

</html>
