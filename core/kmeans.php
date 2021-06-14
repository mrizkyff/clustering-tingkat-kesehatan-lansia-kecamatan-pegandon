<?php
include_once("config.php");
$sql = "SELECT * FROM penyakit ORDER BY id";
$result = $mysqli -> query($sql);

// untuk menampung seluruh data dari database
$all_data = $result->fetch_all();

// ubah kedalam bentuk array
$array_data = [];
foreach ($all_data as $key => $value) {
    $data = [];
    $data['id_doc'] = $value[0];
    $data['nama_desa'] = $value[1];
    $data['mental'] = $value[2];
    $data['imt'] = $value[3];
    $data['tek_darah'] = $value[4];
    $data['hb_kurang'] = $value[5];
    $data['kolesterol'] = $value[6];
    $data['dm'] = $value[7];
    $data['asam_urat'] = $value[8];
    $data['ginjal'] = $value[9];
    $data['kognitif'] = $value[10];
    $data['pengelihatan'] = $value[11];
    $data['pendengaran'] = $value[12];
    $array_data[$value[0]] = $data;
}


// perhitungan euclidean distance
function euclidean_distance($array_data, $centroid){
    $euclid_list = [];
    
    foreach ($array_data as $keys => $data1) {
        $temp = 0;
        foreach ($data1 as $key => $value) {
            if($key != "nama_desa" and $key != "id_doc"){
                $temp += pow($data1[$key]-$centroid[$key],2);
            }
        }
        $euclid_list[$keys] = sqrt($temp);
    }
    return $euclid_list;
}

// fungsi untuk membagi cluster
function bagi_cluster($jarak1, $jarak2){
    // print_r($jarak1);
    // print_r($jarak2);
    // print_r($jarak3);
    $cluster1 = [];
    $cluster2 = [];
    $cluster3 = [];
    foreach ($jarak1 as $key => $value) {
        if($jarak1[$key] < $jarak2[$key]){
            $cluster1[] = $key;
        }
        else if($jarak2[$key] < $jarak1[$key]){
            $cluster2[] = $key;
        }
        else if($jarak1[$key] == $jarak2[$key]){
            $cluster1[] = $key;
        }
    }
    return array(
        'cluster1' => $cluster1,
        'cluster2' => $cluster2,
    );
}

// perhitungan centroid baru
function hitung_centroid($array_data, $cluster){
    $means = [];
    $n = count($cluster);
    $sum = [];
    // siapkan variabel array bernilai nol
    foreach ($cluster as $key => $value) {
        foreach ($array_data as $key1 => $value1) {
            if($value == $key1){
                foreach ($value1 as $key2 => $value2) {
                    if($key2 != "id_doc" and $key2 != "nama_desa"){
                        $sum[$key2] = 0;
                    }
                }
            }
        }
    }

    // assign setiap nilainya kedalam variabel array yang telah dibuat
    foreach ($cluster as $key => $value) {
        foreach ($array_data as $key1 => $value1) {
            if($value == $key1){
                foreach ($value1 as $key2 => $value2) {
                    if($key2 != "id_doc" and $key2 != "nama_desa"){
                        $sum[$key2] += $value2;
                    }
                }
            }
        }
    }

    // hitung rata-rata (means) nya 
    foreach ($sum as $key => $value) {
        $means[$key] = ($n == 0) ? 1 : $value / $n;
    }
    return $means;

}

// perhitungan euclidean terhadap seluruh data
function hitung_kmeans($array_data){
    // menentukan cetroid awal untuk iterasi 1
    $c1 = 1;
    $c2 = 2;

    // menghitung jarak seluruh data dengan setiap centroid yang telah ditentukan
    $jarak1 = euclidean_distance($array_data, $array_data[$c1]);
    $jarak2 = euclidean_distance($array_data, $array_data[$c2]);

    
    // membagi cluster
    $hasil_clustering = bagi_cluster($jarak1, $jarak2);

    // anggota setiap cluster
    $cluster1 = $hasil_clustering['cluster1'];
    $cluster2 = $hasil_clustering['cluster2'];

    print_r(['============= iterasi ke 1 =============']);
    print_r($jarak1);
    print_r($jarak2);
    // print_r($cluster1);
    // print_r($cluster2);
    
    // iterasi 2 dan seterusnya
    $x = 2;
    while($x <= 10){

        // menghitung centroid baru dengan means (rata-rat)
        $centroid1_baru = hitung_centroid($array_data, $cluster1);
        $centroid2_baru = hitung_centroid($array_data, $cluster2);
    
        // menghtiung jarak cluster dari centroid yang baru
        $jarak1_baru = euclidean_distance($array_data, $centroid1_baru);
        $jarak2_baru = euclidean_distance($array_data, $centroid2_baru);
    
        // membagi cluster lagi
        $hasil_clustering_baru = bagi_cluster($jarak1_baru, $jarak2_baru);
    
        // anggota setiap cluster
        $cluster1_baru = $hasil_clustering_baru['cluster1'];
        $cluster2_baru = $hasil_clustering_baru['cluster2'];

        print_r(['============= iterasi ke' => $x]);
        print_r($centroid1_baru);
        print_r($centroid2_baru);
        print_r($jarak1_baru);
        print_r($jarak2_baru);
        // print_r($cluster1_baru);
        // print_r($cluster2_baru);
        if(($hasil_clustering === $hasil_clustering_baru) != 1){
            $hasil_clustering = $hasil_clustering_baru;
        }
        else{
            break;
        }
        $x += 1;
        $cluster1 = $cluster1_baru;
        $cluster2 = $cluster2_baru;
    }
    return $hasil_clustering;
}

// kumpulkan seluruh cluster untuk updating cluster database
$array_cluster = [];
$hasil_akhir = hitung_kmeans($array_data);
foreach ($hasil_akhir as $key => $value) {
    if($key == 'cluster1'){
        foreach ($value as $key1 => $value1) {
            $array_cluster[$value1] = 1;
        }
    }
    else if($key == 'cluster2'){
        foreach ($value as $key1 => $value1) {
            $array_cluster[$value1] = 2;
        }
    }
}

print_r($hasil_akhir);

// // proses update ke database
// foreach ($array_cluster as $id => $cluster) {
//     $result = mysqli_query($mysqli, "UPDATE penyakit SET cluster='$cluster' WHERE id=$id");
//     if(!$result){
//         echo 'error!';
//     }
// }

// header("Location:../klastering.php");
?>


