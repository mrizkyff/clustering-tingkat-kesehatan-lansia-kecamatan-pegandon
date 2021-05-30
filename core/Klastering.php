<?php

class Kmeans
{
    public static function get_rank($query, $dokumen, $c1, $c2, $debug=false)
    {
        $euclidean      = Kmeans::jarak_euclidean($bobot, $debug, $c1, $c2);


        return $euclidean;
    }

    public static function hitung_euclidean($bobot, $centroid, $cbaru = null){
        if($cbaru == null){
            $c = $bobot[$centroid];
        }
        else{
            $c = $centroid;
        }
        
        $euclidean_distance = [];		
        foreach ($bobot as $id_doc => $value) {
            $temp = 0;	
            foreach ($value as $term => $nilainya) {
                // jarak dari centroid
                if($id_doc == $centroid){
                    if(array_key_exists($term, $c)){
                        // print_r([$id_doc => ['sama dengan centroid' => [$term => $nilainya-$nilainya]]]);
                        $temp +=($nilainya-$nilainya);
                    }

                }
                else{
                    // // kalau sama
                    if(array_key_exists($term, $c)){
                        // print_r([$id_doc.'-'.$centroid => ['termnya sama' => [$term => pow(($nilainya - $c[$term]),2)]]]);
                        $temp += pow(($nilainya - $c[$term]),2);
                    }
                    // // kalau di doclist ada, di pusat tidak ada1
                    else if(!array_key_exists($term, $c)){
                        // print_r([$id_doc.'-'.$centroid => ['doclist ada' => [$term => pow($nilainya,2)]]]);
                        $temp += pow($nilainya,2);
                    }
                }
            }
            // // kalau di pusat ada, di doclist tidak ada
            foreach ($c as $term1 => $value1) {
                if(!array_key_exists($term1, $bobot[$id_doc])){
                    // print_r([$id_doc.'-'.$centroid => ['pusat ada' => [$term1 => pow($c[$term1],2)]]]);
                    $temp += pow($c[$term1],2);
                }
            }
            $euclidean_distance['jarak'][$id_doc] = sqrt($temp);		
        }
        return $euclidean_distance;
    }


    public static function bagi_cluster($jarak1, $jarak2){
        $cluster1 = [];
        $cluster2 = [];
        foreach ($jarak1 as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if($value1 < $jarak2[$key][$key1]){
                    $cluster1[] = $key1;
                }
                else if($value1 > $jarak2[$key][$key1]){
                    $cluster2[] = $key1;
                }
                else{
                    $cluster1[] = $key1;
                }
            }
        }
        return array(
            'cluster1' => $cluster1,
            'cluster2' => $cluster2
        );
    }

    public static function hitung_centroid($cluster, $bobot){
        $means = [];

        $n = count($cluster);
        $sum = [];
        foreach($cluster as $key=>$value){
            foreach ($bobot as $key1 => $value1) {
                foreach ($value1 as $key2 => $value2) {
                    if($key1 == $value){
                        // jika sama, ada nilai di kedua dokumen, langsung assign 0
                        $sum[$key2] = 0;
                    }
                }
            }
        }
        foreach($cluster as $key=>$value){
            foreach ($bobot as $key1 => $value1) {
                foreach ($value1 as $key2 => $value2) {
                    if($key1 == $value){
                        $sum[$key2] += $value2;
                    }
                }
            }
        }
        
        foreach ($sum as $key => $value) {
            $means[$key] = ($n == 0) ? 1 : $value / $n;
        }

        return $means;
    }

    public static function jarak_euclidean($bobot, $debug, $c1, $c2){

        // ITERASI 1
        // $c1 = 2;
        // $c2 = 45;

        // berita
        // 2 9
        // 2 13
        // 2 14
        // 2 18
        // 2 21

        // all smsv2
        // 2 14
        // 2 15
        // 2 18
        // 2 19
        // 2 21
        // 2 22

        // modul
        // 1 4

        // sms fix
        // 2 7
        // 2 25
        // 2 28
        // 2 37
        // 2 45 


        $cluster1 = Kmeans::hitung_euclidean($bobot, $c1);
        $cluster2 = Kmeans::hitung_euclidean($bobot, $c2);

        $hasil_clustering = Kmeans::bagi_cluster($cluster1, $cluster2);

        $c1_temp = $hasil_clustering['cluster1'];
        $c2_temp = $hasil_clustering['cluster2'];
        
        // ITERASI 2 DST
        $hasil_clustering_baru = [];

        $x = 2;
        do {
            $x+=1;
            // menghitung centroid baru (means)
            $centroid1_baru = Kmeans::hitung_centroid($c1_temp, $bobot);
            $centroid2_baru = Kmeans::hitung_centroid($c2_temp, $bobot);
            
            // menghitung jarak cluster dari centroid yang baru
            $cluster_baru1 = Kmeans::hitung_euclidean($bobot, $centroid1_baru, 'baru');
            $cluster_baru2 = Kmeans::hitung_euclidean($bobot, $centroid2_baru, 'baru');
            
            // membagi cluster sesuai dengan clusternya
            $hasil_clustering_baru = Kmeans::bagi_cluster($cluster_baru1, $cluster_baru2);
            
            $c1_temp = $hasil_clustering_baru['cluster1'];
            $c2_temp = $hasil_clustering_baru['cluster2'];

            // dibatasi hanya sampai 20 iterasi
            if($x == 20){
                break;
            }
            // berhenti jika hasil cluster lama dan baru itu sama
        } while (($hasil_clustering === $hasil_clustering_baru) != 1);

        $verdict = '';
        if(in_array('1', $hasil_clustering_baru['cluster1'])){
            // print_r(['hasil :' => 'ekonomi']);
            $verdict = 'spam';
        }
        else if(in_array('1', $hasil_clustering_baru['cluster2'])){
            // print_r(['hasil :' => 'olahraga']);
            $verdict = 'real';
        }

        return [
            'hasil_clustering' => $hasil_clustering_baru,
            'kesimpulan' => $verdict
        ];


    }
}

?>