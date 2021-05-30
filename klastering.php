<?php
// Create database connection using config file
include_once("core/config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM penyakit ORDER BY cluster ASC");
?>
 
<html>
<head>    
    <title>Hasil Cluster</title>
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    </head>
</head>
 
<body>
<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">K-Means Clustering</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Dataset</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="klastering.php">Hasil Klastering</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- navigation bar -->
 
    <div class="container mt-5 ">
        <h1 class="text-center mb-3">Hasil Clustering Tingkat Kesehatan Lansia Kecamatan Pegandon 2018-2019</h1>
        <table class="table table-bordered table-striped table-sm table-hover" style="margin-top: 50px;">
            <tr>
                <th>No</th>
                <th>Nama Desa</th>
                <th>Ggn. Mental</th>
                <th>IMT</th>
                <th>Tek. Darah</th>
                <th>Hb. Kurang</th>
                <th>Kolesterol</th>
                <th>Diabetes M</th>
                <th>As. Urat</th>
                <th>Ggn. Ginjal</th>
                <th>Ggn. Kognitif</th>
                <th>Ggn. Pengelihatan</th>
                <th>Ggn. Pendengaran</th>
                <th>Cluster</th>
            </tr>
            <?php  
            $no = 1;
            while($user_data = mysqli_fetch_array($result)) {         
            ?>
            
            <tr>
               <td class='text-center'><?=$no?></td>
               <td ><?=$user_data['nama_desa']?></td>
               <td class='text-center'><?=$user_data['mental']?></td>
               <td class='text-center'><?=$user_data['imt']?></td>
               <td class='text-center'><?=$user_data['tek_darah']?></td>
               <td class='text-center'><?=$user_data['hb_kurang']?></td>
               <td class='text-center'><?=$user_data['kolesterol']?></td>
               <td class='text-center'><?=$user_data['dm']?></td>
               <td class='text-center'><?=$user_data['asam_urat']?></td>
               <td class='text-center'><?=$user_data['ginjal']?></td>
               <td class='text-center'><?=$user_data['kognitif']?></td>
               <td class='text-center'><?=$user_data['pengelihatan']?></td>
               <td class='text-center'><?=$user_data['pendengaran']?></td>
               <td class='text-center'><?=$user_data['cluster']?></td>
            </tr>
            <?php   
                $no += 1;
                }
            ?>
        </table>
    </div>
    


    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>