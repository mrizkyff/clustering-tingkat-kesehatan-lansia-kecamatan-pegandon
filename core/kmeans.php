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

// print_r($array_data);
// print_r(euclidean_distance($array_data[1], $array_data[8]));
hitung_euclidean($array_data);

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
function bagi_cluster($jarak1, $jarak2, $jarak3){
    // print_r($jarak1);
    // print_r($jarak2);
    // print_r($jarak3);
    $cluster1 = [];
    $cluster2 = [];
    $cluster3 = [];
    foreach ($jarak1 as $key => $value) {
        if($jarak1[$key] < $jarak2[$key] and $jarak1[$key] < $jarak3[$key]){
            $cluster1[] = $key;
        }
        else if($jarak2[$key] < $jarak1[$key] and $jarak2[$key] < $jarak3[$key]){
            $cluster2[] = $key;
        }
        else if($jarak3[$key] < $jarak1[$key] and $jarak3[$key] < $jarak2[$key]){
            $cluster3[] = $key;
        }
        else if($jarak1[$key] == $jarak2[$key] or $jarak1[$key] == $jarak3[$key] or $jarak2[$key] == $jarak3[$key]){
            $cluster1[] = $key;
        }
    }
    return array(
        'cluster1' => $cluster1,
        'cluster2' => $cluster2,
        'cluster3' => $cluster3,
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
    print_r($means);

}

// perhitungan euclidean terhadap seluruh data
function hitung_euclidean($array_data){
    // menentukan cetroid awal untuk iterasi 1
    $c1 = 6;
    $c2 = 8;
    $c3 = 12;

    // menghitung jarak seluruh data dengan setiap centroid yang telah ditentukan
    $jarak1 = euclidean_distance($array_data, $array_data[$c1]);
    $jarak2 = euclidean_distance($array_data, $array_data[$c2]);
    $jarak3 = euclidean_distance($array_data, $array_data[$c3]);

    
    // membagi cluster
    $hasil_clustering = bagi_cluster($jarak1, $jarak2, $jarak3);

    // anggota setiap cluster
    $cluster1 = $hasil_clustering['cluster1'];
    $cluster2 = $hasil_clustering['cluster2'];
    $cluster3 = $hasil_clustering['cluster3'];

    // iterasi 2 dan seterusnya
    $centroid1_baru = hitung_centroid($array_data, $cluster2);

    $x = 2;
    do{

        // menghitung centroid baru dengan means (rata-rat)

        $x += 1;
        // if($x == 10){
        //     break;
        // }
        // print($x);
    } while($x < 10);
}
?>