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
       $query = "SELECT tanggal_prediksi from resource";
       $res = mysqli_query($con, $query);
       $tanggal_upload = $res->fetch_object()->tanggal_prediksi;
     }
 ?>

 <!DOCTYPE html>
<html lang="en">
  <head>
    <title>Seach Data</title>
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
        <li><a href="table.php?page=1">Data Harian</a></li>
        <li class="active"><a href="table.php?page=1">Search<span class="sr-only">(current)</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div>
  </nav>
    <div class="container-fluid">

    <h1 class="text-center margin-top">Search Data Pelanggan Telkom Witel Bali Selatan</h1>
    <h5 class="text-center">Upload data terakhir : <?php echo $tanggal_upload;?></h5>
    <div class="row media">
      <div class="col-md-6 col-md-offset-3">
        <div class="col-xs-5 col-md-3">
          <select class="form-control" id="selector">
            <option value="nama_customer">Nama</option>
            <option value="ncli">Ncli</option>
          </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
          <input type="text" class="form-control" placeholder="Ketik disini ..." name="search" id="search">
        </div>
      </div>
    </div>
    <div class="row media">
      <div class="col-xs-12 col-md-12">
      
        <div id="resultsearch">
        </div>
      </div>
    </div> 
      
    </div>



    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

      <script>
    $(document).ready(function(){
      $('#tbleres').hide();
      $('#search').keyup(function(){
        var search = $('#search').val();
        var selection = $('#selector').val();

        if($('#search').val() == ""){
          $('#resultsearch').hide();
        } else {
          // start AJAX
          $.ajax({
            url:'getsearch.php',
            data: {search:search, 
              selection:selection},
              type: 'POST',
              success: function(data){

                if(!data.error){
                  $('#resultsearch').show();
                  $("#resultsearch").html(data);
                }
              }
            });
        }
        

      });

    });

  </script>

  </body>
</html>
