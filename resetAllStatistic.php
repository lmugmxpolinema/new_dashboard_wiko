<?php
// admin/api/resetAllStatistic.php

// Data lokasi: pastikan seluruh 16 titik sudah terdaftar di sini
$locations = [
    [
        "name" => "Pasar Beringharjo",
        "alias" => "Pasar Beringharjo",
        "api_url" => "http://172.16.115.222:8254/admin/api/resetStatistic?type=customerCount", 
        "api_token" => "4dsn32ioao"
    ],
    [
        "name" => "Angkringan Bu Indah",
        "alias" => "Angkringan Bu Indah",
        "api_url" => "http://111.92.166.185:6362/admin/api/resetStatistic?type=customerCount",
        "api_token" => "toov0v52ds"
    ],
    [
        "name" => "Kedai Nan-nin",
        "alias" => "Kedai Nan-nin",
        "api_url" => "http://111.92.166.185:6364/admin/api/resetStatistic?type=customerCount",
        "api_token" => "rlvwsebm0g"
    ],
    [
        "name" => "Warmindo Pandawa 2",
        "alias" => "Warmindo Pandawa 2",
        "api_url" => "http://192.168.0.7:8254/admin/api/resetStatistic?type=customerCount",
        "api_token" => "gnm8gzhh34"
    ],
    [
        "name" => "Breksi 1",
        "alias" => "Breksi 1",
        "api_url" => "http://111.92.166.185:6441/admin/api/resetStatistic?type=customerCount",
        "api_token" => "kd9kt5r05c"
    ],
    [
        "name" => "Breksi 2",
        "alias" => "Breksi 2",
        "api_url" => "http://111.92.166.185:6442/admin/api/resetStatistic?type=customerCount",
        "api_token" => "j40qpc3ajk"
    ],
    [
        "name" => "Breksi 3",
        "alias" => "Breksi 3",
        "api_url" => "http://111.92.166.185:6443/admin/api/resetStatistic?type=customerCount",
        "api_token" => "0oix116eww"
    ],
    [
        "name" => "Asrama Kompi",
        "alias" => "Asrama Kompi",
        "api_url" => "http://111.92.166.185:6361/admin/api/resetStatistic?type=customerCount",
        "api_token" => "zq9yu7lrls"
    ],
    [
        "name" => "Lapangan Karang",
        "alias" => "Lapangan Karang",
        "api_url" => "http://111.92.166.185:6366/admin/api/resetStatistic?type=customerCount",
        "api_token" => "79ib6sagwg"
    ],
    [
        "name" => "Lapangan Jambidan",
        "alias" => "Lapangan Jambidan",
        "api_url" => "http://111.92.166.134:8254/admin/api/resetStatistic?type=customerCount",
        "api_token" => "niulr1eosg"
    ],
    [
        "name" => "Kota gede",
        "alias" => "Pendopo Kajengan",
        "api_url" => "http://111.92.166.185:6367/admin/api/resetStatistic?type=customerCount",
        "api_token" => "saxgku71xc"
    ],
    [
        "name" => "Alkid",
        "alias" => "Alkid",
        "api_url" => "http://10.119.2.20:8254/admin/api/resetStatistic?type=customerCount",
        "api_token" => "lcw3bctjm8"
    ],
    [
        "name" => "Krapyak",
        "alias" => "Krapyak",
        "api_url" => "http://111.92.166.185:6369/admin/api/resetStatistic?type=customerCount",
        "api_token" => "ed75wfbj6o"
    ],
    [
        "name" => "Lesehan Anugrah",
        "alias" => "Lesehan Anugrah",
        "api_url" => "http://111.92.166.185:6370/admin/api/resetStatistic?type=customerCount",
        "api_token" => "xoiooidzcw"
    ],
    [
        "name" => "Angkringan Sobo",
        "alias" => "Angkringan Sobo",
        "api_url" => "http://111.92.166.185:6371/admin/api/resetStatistic?type=customerCount",
        "api_token" => "cuidbuf2j4"
    ],
    [
        "name" => "Warmindo Pak Ndut",
        "alias" => "Warmindo Pak Ndut",
        "api_url" => "http://111.92.166.185:6372/admin/api/resetStatistic?type=customerCount",
        "api_token" => "4cki6f5idc"
    ],
    [
        "name" => "Pasar Beringharjo",
        "alias" => "Pasar Beringharjo",
        "api_url" => "http://172.16.115.222:8254/admin/api/resetStatistic?type=lifeCoinCount", 
        "api_token" => "4dsn32ioao"
    ],
    [
        "name" => "Angkringan Bu Indah",
        "alias" => "Angkringan Bu Indah",
        "api_url" => "http://111.92.166.185:6362/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "toov0v52ds"
    ],
    [
        "name" => "Kedai Nan-nin",
        "alias" => "Kedai Nan-nin",
        "api_url" => "http://111.92.166.185:6364/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "rlvwsebm0g"
    ],
    [
        "name" => "Warmindo Pandawa 2",
        "alias" => "Warmindo Pandawa 2",
        "api_url" => "http://192.168.0.7:8254/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "gnm8gzhh34"
    ],
    [
        "name" => "Breksi 1",
        "alias" => "Breksi 1",
        "api_url" => "http://111.92.166.185:6441/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "kd9kt5r05c"
    ],
    [
        "name" => "Breksi 2",
        "alias" => "Breksi 2",
        "api_url" => "http://111.92.166.185:6442/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "j40qpc3ajk"
    ],
    [
        "name" => "Breksi 3",
        "alias" => "Breksi 3",
        "api_url" => "http://111.92.166.185:6443/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "0oix116eww"
    ],
    [
        "name" => "Asrama Kompi",
        "alias" => "Asrama Kompi",
        "api_url" => "http://111.92.166.185:6361/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "zq9yu7lrls"
    ],
    [
        "name" => "Lapangan Karang",
        "alias" => "Lapangan Karang",
        "api_url" => "http://111.92.166.185:6366/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "79ib6sagwg"
    ],
    [
        "name" => "Lapangan Jambidan",
        "alias" => "Lapangan Jambidan",
        "api_url" => "http://111.92.166.134:8254/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "niulr1eosg"
    ],
    [
        "name" => "Kota gede",
        "alias" => "Pendopo Kajengan",
        "api_url" => "http://111.92.166.185:6367/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "saxgku71xc"
    ],
    [
        "name" => "Alkid",
        "alias" => "Alkid",
        "api_url" => "http://10.119.2.20:8254/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "lcw3bctjm8"
    ],
    [
        "name" => "Krapyak",
        "alias" => "Krapyak",
        "api_url" => "http://111.92.166.185:6369/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "ed75wfbj6o"
    ],
    [
        "name" => "Lesehan Anugrah",
        "alias" => "Lesehan Anugrah",
        "api_url" => "http://111.92.166.185:6370/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "xoiooidzcw"
    ],
    [
        "name" => "Angkringan Sobo",
        "alias" => "Angkringan Sobo",
        "api_url" => "http://111.92.166.185:6371/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "cuidbuf2j4"
    ],
    [
        "name" => "Warmindo Pak Ndut",
        "alias" => "Warmindo Pak Ndut",
        "api_url" => "http://111.92.166.185:6372/admin/api/resetStatistic?type=lifeCoinCount",
        "api_token" => "4cki6f5idc"
    ],
    [
        "name" => "Pasar Beringharjo",
        "alias" => "Pasar Beringharjo",
        "api_url" => "http://172.16.115.222:8254/admin/api/resetStatistic?type=coinCount", 
        "api_token" => "4dsn32ioao"
    ],
    [
        "name" => "Angkringan Bu Indah",
        "alias" => "Angkringan Bu Indah",
        "api_url" => "http://111.92.166.185:6362/admin/api/resetStatistic?type=coinCount",
        "api_token" => "toov0v52ds"
    ],
    [
        "name" => "Kedai Nan-nin",
        "alias" => "Kedai Nan-nin",
        "api_url" => "http://111.92.166.185:6364/admin/api/resetStatistic?type=coinCount",
        "api_token" => "rlvwsebm0g"
    ],
    [
        "name" => "Warmindo Pandawa 2",
        "alias" => "Warmindo Pandawa 2",
        "api_url" => "http://192.168.0.7:8254/admin/api/resetStatistic?type=coinCount",
        "api_token" => "gnm8gzhh34"
    ],
    [
        "name" => "Breksi 1",
        "alias" => "Breksi 1",
        "api_url" => "http://111.92.166.185:6441/admin/api/resetStatistic?type=coinCount",
        "api_token" => "kd9kt5r05c"
    ],
    [
        "name" => "Breksi 2",
        "alias" => "Breksi 2",
        "api_url" => "http://111.92.166.185:6442/admin/api/resetStatistic?type=coinCount",
        "api_token" => "j40qpc3ajk"
    ],
    [
        "name" => "Breksi 3",
        "alias" => "Breksi 3",
        "api_url" => "http://111.92.166.185:6443/admin/api/resetStatistic?type=coinCount",
        "api_token" => "0oix116eww"
    ],
    [
        "name" => "Asrama Kompi",
        "alias" => "Asrama Kompi",
        "api_url" => "http://111.92.166.185:6361/admin/api/resetStatistic?type=coinCount",
        "api_token" => "zq9yu7lrls"
    ],
    [
        "name" => "Lapangan Karang",
        "alias" => "Lapangan Karang",
        "api_url" => "http://111.92.166.185:6366/admin/api/resetStatistic?type=coinCount",
        "api_token" => "79ib6sagwg"
    ],
    [
        "name" => "Lapangan Jambidan",
        "alias" => "Lapangan Jambidan",
        "api_url" => "http://111.92.166.134:8254/admin/api/resetStatistic?type=coinCount",
        "api_token" => "niulr1eosg"
    ],
    [
        "name" => "Kota gede",
        "alias" => "Pendopo Kajengan",
        "api_url" => "http://111.92.166.185:6367/admin/api/resetStatistic?type=coinCount",
        "api_token" => "saxgku71xc"
    ],
    [
        "name" => "Alkid",
        "alias" => "Alkid",
        "api_url" => "http://10.119.2.20:8254/admin/api/resetStatistic?type=coinCount",
        "api_token" => "lcw3bctjm8"
    ],
    [
        "name" => "Krapyak",
        "alias" => "Krapyak",
        "api_url" => "http://111.92.166.185:6369/admin/api/resetStatistic?type=coinCount",
        "api_token" => "ed75wfbj6o"
    ],
    [
        "name" => "Lesehan Anugrah",
        "alias" => "Lesehan Anugrah",
        "api_url" => "http://111.92.166.185:6370/admin/api/resetStatistic?type=coinCount",
        "api_token" => "xoiooidzcw"
    ],
    [
        "name" => "Angkringan Sobo",
        "alias" => "Angkringan Sobo",
        "api_url" => "http://111.92.166.185:6371/admin/api/resetStatistic?type=coinCount",
        "api_token" => "cuidbuf2j4"
    ],
    [
        "name" => "Warmindo Pak Ndut",
        "alias" => "Warmindo Pak Ndut",
        "api_url" => "http://111.92.166.185:6372/admin/api/resetStatistic?type=coinCount",
        "api_token" => "4cki6f5idc"
    ]
];

// Inisialisasi cURL multi untuk mengirim reset ke semua lokasi secara paralel
$multiCurl = curl_multi_init();
$curlArray = [];

foreach ($locations as $location) {
    $curl = curl_init($location["api_url"]);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "X-TOKEN: {$location['api_token']}",
        "Accept: application/json",
        "Authorization: Bearer {$location['api_token']}"
    ]);
    curl_multi_add_handle($multiCurl, $curl);
    $curlArray[] = $curl;
}

$running = null;
do {
    $status = curl_multi_exec($multiCurl, $running);
    if ($status === CURLM_CALL_MULTI_PERFORM) {
        continue;
    }
    curl_multi_select($multiCurl); // Menghindari penggunaan CPU 100%
} while ($running);

// Kumpulkan respons
$responses = [];
foreach ($curlArray as $curl) {
    $responses[] = curl_multi_getcontent($curl);
    curl_multi_remove_handle($multiCurl, $curl);
    curl_close($curl);
}
curl_multi_close($multiCurl);

// Berikan respons JSON ke client
echo json_encode([
    "status" => "success",
    "responses" => $responses
]);
?>
