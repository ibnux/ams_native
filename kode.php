<?php
// Cegah direct akses ajax.
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    // Set header type konten.
    header("Content-Type: application/json; charset=UTF-8");

    require_once 'vendor/autoload.php';
    require_once 'include/config.php';
    require_once 'include/functions.php';


    // Deklarasi variable keyword kode.
    $kode = $_GET["query"];

    // Query ke database.
    $query  = $db->select('tbl_klasifikasi', "*",['OR'=>['kode[~]'=> $kode,'nama[~]'=>$kode, 'uraian'=>$kode]]);
    if (count($query) > 0){
        // Format bentuk data untuk autocomplete.
        foreach($query as $data){
            $output['suggestions'][] = [
                'value' => $data['kode'] . " - " . $data['nama'],
                'kode'  => $data['kode']
            ];
        }
    } else {
        $output['suggestions'][] = [
            'value' => '',
            'kode'  => ''
        ];
    }

    // Encode ke json.
    echo json_encode($output);
}
