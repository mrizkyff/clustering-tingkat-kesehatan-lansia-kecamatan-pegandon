<?php
include_once("config.php");

        if(isset($_POST['Submit'])){
            $nama_desa = $_POST['nama_desa'];
            $mental = $_POST['mental'];
            $imt = $_POST['imt'];
            $tek_darah = $_POST['tek_darah'];
            $hb_kurang = $_POST['hb_kurang'];
            $kolesterol = $_POST['kolesterol'];
            $dm = $_POST['dm'];
            $as_urat = $_POST['as_urat'];
            $ginjal = $_POST['ginjal'];
            $kognitif = $_POST['kognitif'];
            $pengelihatan = $_POST['pengelihatan'];
            $pendengaran = $_POST['pendengaran'];

            // include database connection file
            // include_once("core/config.php");
                    
            // Insert user data into table
            $result = mysqli_query($mysqli, "INSERT INTO penyakit(nama_desa, mental, imt, tek_darah, hb_kurang, kolesterol, dm, asam_urat, ginjal, kognitif, pengelihatan, pendengaran) VALUES('$nama_desa','$mental','$imt','$tek_darah','$hb_kurang','$kolesterol','$dm','$as_urat','$ginjal','$kognitif','$pengelihatan','$pendengaran')");
            
            // Show message when user added
            if($result){
                header("Location:../index.php");
            }
            else{
                echo 'error!';
            }

        }

        if(isset($_POST['Delete'])){
            $id = $_POST['id_hapus'];

            // Delete user row from table based on given id
            $result = mysqli_query($mysqli, "DELETE FROM penyakit WHERE id=$id");
            
            // After delete redirect to Home, so that latest user list will be displayed.
            if($result){
                header("Location:../index.php");
            }
            else{
                echo 'error!';
            }
        }

        if(isset($_POST['Update'])){
            $id = $_POST['id_update'];

            $nama_desa = $_POST['nama_desa'];
            $mental = $_POST['mental'];
            $imt = $_POST['imt'];
            $tek_darah = $_POST['tek_darah'];
            $hb_kurang = $_POST['hb_kurang'];
            $kolesterol = $_POST['kolesterol'];
            $dm = $_POST['dm'];
            $as_urat = $_POST['as_urat'];
            $ginjal = $_POST['ginjal'];
            $kognitif = $_POST['kognitif'];
            $pengelihatan = $_POST['pengelihatan'];
            $pendengaran = $_POST['pendengaran'];

            // update user data
            $result = mysqli_query($mysqli, "UPDATE penyakit SET nama_desa='$nama_desa',mental='$mental',imt='$imt',tek_darah='$tek_darah',hb_kurang='$hb_kurang',kolesterol='$kolesterol',dm='$dm',asam_urat='$as_urat',ginjal='$ginjal',kognitif='$kognitif',pengelihatan='$pengelihatan',pendengaran='$pendengaran' WHERE id=$id");
            
            // Redirect to homepage to display updated user in list
            if($result){
                header("Location:../index.php");
            }
            else{
                echo 'error!';
            }

            // return $result;

        }
    ?>