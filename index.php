<?php
// Create database connection using config file
include_once("core/config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM penyakit ORDER BY id ASC");
?>
 
<html>
<head>    
    <title>Dataset</title>
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
        <h1 class="text-center mb-3">Tabel Tingkat Penyakit Lansia Kecamatan Pegandon 2018-2019</h1>
        <a href="core/kmeans.php" class="btn btn-sm btn-primary" style="float:right; margin-left: 10px;" ><i class="fas fa-cogs"></i> Clustering!</a>
        <a href="#" class="btn btn-sm btn-success" style="float: right;" data-bs-toggle="modal" data-bs-target="#modalTambah"> <i class="fas fa-plus    "></i> Tambah Data Baru</a>
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
                <th>Aksi</th>
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
               <td width='130px;'><button class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#modalEdit<?= $user_data['id']?>'>Edit</button> | <form class='d-inline' method='POST' action='core/crud.php'> <input type='hidden' name='id_hapus' value='<?= $user_data["id"] ?>'> <input type='submit' name='Delete' value='Delete' class='btn btn-danger btn-sm'></form></td>
                <!-- modal edit data -->
                <div class="modal fade" id="modalEdit<?= $user_data['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <input type="hidden" name="id_edit">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="core/crud.php" method="POST">
                                <div class="form-group">
                                    <label for="nama_desa">Nama Desa</label>
                                    <input type="hidden" value="<?= $user_data['id']?>" name="id_update">
                                    <input class="form-control form-control-sm" value="<?= $user_data["nama_desa"] ?>" type="text" name="nama_desa">
                                </div>  
                                <div class="form-group">
                                    <label for="mental">Gangguan Mental</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["mental"] ?>" type="number" name="mental">
                                </div>  
                                <div class="form-group">
                                    <label for="imt">IMT</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["imt"] ?>" type="number" name="imt">
                                </div>  
                                <div class="form-group">
                                    <label for="tek_darah">Tekanan Darah</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["tek_darah"] ?>" type="number" name="tek_darah">
                                </div>  
                                <div class="form-group">
                                    <label for="hb_kurang">Hb Kurang</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["hb_kurang"] ?>" type="number" name="hb_kurang">
                                </div>  
                                <div class="form-group">
                                    <label for="kolesterol">Koleseterol</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["kolesterol"] ?>" type="number" name="kolesterol">
                                </div>  
                                <div class="form-group">
                                    <label for="dm">Diabetes Melitus</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["dm"] ?>" type="number" name="dm">
                                </div>  
                                <div class="form-group">
                                    <label for="as_urat">Asam Urat</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["asam_urat"] ?>" type="number" name="as_urat">
                                </div>  
                                <div class="form-group">
                                    <label for="ginjal">Gangguan Ginjal</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["ginjal"] ?>" type="number" name="ginjal">
                                </div>  
                                <div class="form-group">
                                    <label for="kognitif">Gangguan Kognitif</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["kognitif"] ?>" type="number" name="kognitif">
                                </div>  
                                <div class="form-group">
                                    <label for="pengelihatan">Gangguan Pengelihatan</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["pengelihatan"] ?>" type="number" name="pengelihatan">
                                </div>  
                                <div class="form-group">
                                    <label for="pendengaran">Gangguan Pendengaran</label>
                                    <input class="form-control form-control-sm" value="<?= $user_data["pendengaran"] ?>" type="number" name="pendengaran">
                                </div>  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="Update" value="Simpan" class="btn btn-success">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- akhir modal edit data -->
            </tr>
            <?php   
                $no += 1;
                }
            ?>
        </table>
    </div>
    

    <!-- modal tambah data -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <input type='hidden' name='id_hapus' id=''>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="core/crud.php" method="POST">
                    <div class="form-group">
                        <label for="nama_desa">Nama Desa</label>
                        <input class="form-control form-control-sm" type="text" name="nama_desa">
                    </div>  
                    <div class="form-group">
                        <label for="mental">Gangguan Mental</label>
                        <input class="form-control form-control-sm" type="number" name="mental">
                    </div>  
                    <div class="form-group">
                        <label for="imt">IMT</label>
                        <input class="form-control form-control-sm" type="number" name="imt">
                    </div>  
                    <div class="form-group">
                        <label for="tek_darah">Tekanan Darah</label>
                        <input class="form-control form-control-sm" type="number" name="tek_darah">
                    </div>  
                    <div class="form-group">
                        <label for="hb_kurang">Hb Kurang</label>
                        <input class="form-control form-control-sm" type="number" name="hb_kurang">
                    </div>  
                    <div class="form-group">
                        <label for="kolesterol">Koleseterol</label>
                        <input class="form-control form-control-sm" type="number" name="kolesterol">
                    </div>  
                    <div class="form-group">
                        <label for="dm">Diabetes Melitus</label>
                        <input class="form-control form-control-sm" type="number" name="dm">
                    </div>  
                    <div class="form-group">
                        <label for="as_urat">Asam Urat</label>
                        <input class="form-control form-control-sm" type="number" name="as_urat">
                    </div>  
                    <div class="form-group">
                        <label for="ginjal">Gangguan Ginjal</label>
                        <input class="form-control form-control-sm" type="number" name="ginjal">
                    </div>  
                    <div class="form-group">
                        <label for="kognitif">Gangguan Kognitif</label>
                        <input class="form-control form-control-sm" type="number" name="kognitif">
                    </div>  
                    <div class="form-group">
                        <label for="pengelihatan">Gangguan Pengelihatan</label>
                        <input class="form-control form-control-sm" type="number" name="pengelihatan">
                    </div>  
                    <div class="form-group">
                        <label for="pendengaran">Gangguan Pendengaran</label>
                        <input class="form-control form-control-sm" type="number" name="pendengaran">
                    </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="Submit" value="Tambah" class="btn btn-success">
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- akhir modal tambah data -->

    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>