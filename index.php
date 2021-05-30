<?php
// Create database connection using config file
include_once("core/config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM penyakit ORDER BY id DESC");
?>
 
<html>
<head>    
    <title>Homepage</title>
</head>
 
<body>
<a href="add.php">Add New User</a><br/><br/>
 
    <table width='80%' border=1>
 
    <tr>
        <th>No</th>
        <th>Nama Desa</th>
        <th>Ggn. Mental</th>
        <th>IMT</th>
        <th>Tek. Darah</th>
        <th>Hb. Kurang</th>
        <th>Kolesterol</th>
        <th>DM</th>
        <th>As. Urat</th>
        <th>Ggn. Ginjal</th>
        <th>Ggn. Kognitif</th>
        <th>Ggn. Pengelihatan</th>
        <th>Ggn. Pendengaran</th>
    </tr>
    <?php  
    $no = 1;
    while($user_data = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$user_data['nama_desa']."</td>";
        echo "<td>".$user_data['mental']."</td>";
        echo "<td>".$user_data['imt']."</td>";
        echo "<td>".$user_data['tek_darah']."</td>";
        echo "<td>".$user_data['hb_kurang']."</td>";
        echo "<td>".$user_data['kolesterol']."</td>";
        echo "<td>".$user_data['dm']."</td>";
        echo "<td>".$user_data['asam_urat']."</td>";
        echo "<td>".$user_data['ginjal']."</td>";
        echo "<td>".$user_data['kognitif']."</td>";
        echo "<td>".$user_data['pengelihatan']."</td>";
        echo "<td>".$user_data['pendengaran']."</td>";
        // echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";        
        echo "</tr>";
        $no += 1;
    }
    ?>
    </table>
    <a href="core/kmeans.php">Hitung K-Means</a>
</body>
</html>