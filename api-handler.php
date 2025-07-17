<?php
// Data lokasi
$locations = [
    [
        "id" => "CL000003",
        "name" => "Pasar Beringharjo",
        "alias" => "Pasar Beringharjo",
        "api_url" => "http://172.16.115.222:8254/admin/api/dashboard?query=1739408206569",
        "api_token" => "4dsn32ioao",	
    ],
    [
        "id" => "WCC-RW8SOROSUTAN",
        "name" => "Angkringan Bu Indah",
        "alias" => "Angkringan Bu Indah",
        "api_url" => "http://111.92.166.185:6362/admin/api/dashboard?query=1739408346177",
        "api_token" => "toov0v52ds",
    ],
    [
        "id" => "WIFI-COIN-RT001RW003JAGALAN",
        "name" => "Kedai Nan-nin",
        "alias" => "Kedai Nan-nin",
        "api_url" => "http://111.92.166.185:6364/admin/api/dashboard?query=1739408728112",
        "api_token" => "rlvwsebm0g",
    ],
    [
        "id" => "tanpaID-1",
        "name" => "Warmindo Pandawa 2",
        "alias" => "Warmindo Pandawa 2",
        "api_url" => "http://192.168.0.7:8254/admin/api/dashboard?query=1739408808541",
        "api_token" => "gnm8gzhh34",
    ],
    [
        "id" => "146145112051",
        "name" => "Breksi 1",
        "alias" => "Breksi 1",
        "api_url" => "http://111.92.166.185:6441/admin/api/dashboard?query=1739408870831",
        "api_token" => "kd9kt5r05c",
    ],
    [
        "id" => 146145112051-2,
        "name" => "Breksi 2",
        "alias" => "Breksi 2",
        "api_url" => "http://111.92.166.185:6442/admin/api/dashboard?query=1739408948754",
        "api_token" => "j40qpc3ajk",
    ],
    [
        "id" => 146145112051-3,
        "name" => "Breksi 3",
        "alias" => "Breksi 3",
        "api_url" => "http://111.92.166.185:6443/admin/api/dashboard?query=1739409689454",
        "api_token" => "0oix116eww",
    ],
    [
        "id" => "JP003296",        
        "name" => "Lapangan Karang",
        "alias" => "Lapangan Karang",
        "api_url" => "http://111.92.166.185:6366/admin/api/dashboard?query=1739409515203",
        "api_token" => "79ib6sagwg",
    ],
    [
        "id" => "tanpaID-2",        
        "name" => "Lapangan Jambidan",
        "alias" => "Lapangan Jambidan",
        "api_url" => "http://111.92.166.134:8254/admin/api/dashboard?query=1739409598065",
        "api_token" => "niulr1eosg",
    ],
    [
        "id" => "JP003544",        
        "name" => "Kota gede",
        "alias" => "Pendopo Kajengan",
        "api_url" => "http://111.92.166.185:6367/admin/api/dashboard?query=1739409826165",
        "api_token" => "saxgku71xc",
    ],
    [
        "id" => "JSS-ALUN2-KIDUL",        
        "name" => "Alkid",
        "alias" => "Alkid",
        "api_url" => "http://10.119.2.20:8254/admin/api/dashboard?query=1739410022743",
        "api_token" => "2css8c3ok0",    
    ],
    [
        "id" => "LM003833",        
        "name" => "Krapyak",
        "alias" => "Krapyak",
        "api_url" => "http://111.92.166.185:6369/admin/api/dashboard?query=1739410081218",
        "api_token" => "ed75wfbj6o",
    ],
    [
        "id" => "JP000879",        
        "name" => "Lesehan Anugrah",
        "alias" => "Lesehan Anugrah",
        "api_url" => "http://111.92.166.185:6370/admin/api/dashboard?query=1739410211094",
        "api_token" => "xoiooidzcw",
    ],
    [
        "id" => "LM004094",        
        "name" => "Angkringan Sobo",
        "alias" => "Angkringan Sobo",
        "api_url" => "http://111.92.166.185:6371/admin/api/dashboard?query=1739756118379",
        "api_token" => "cuidbuf2j4",
    ],
    [
        "id" => "LM004293",        
        "name" => "Warmindo Pak Ndut",
        "alias" => "Warmindo Pak Ndut",
        "api_url" => "http://111.92.166.185:6372/admin/api/dashboard?query=1740024607738",
        "api_token" => "4cki6f5idc",    
    ],
    [
        "id" => "LM004731",        	
        "name" => "Pasar Ngasem",
        "alias" => "Pasar Ngasem",
        "api_url" => "http://10.249.131.6:8254/admin/api/dashboard?query=1748916484399",
        "api_token" => "ux4ja6nomo",
    ],
    [
        "id" => "XM004738",
        "name" => "Stasiun Tugu",
        "alias" => "Stasiun Tugu",
        "api_url" => "http://111.92.166.185:6374/admin/api/dashboard?query=1751956210120",
        "api_token" => "t1ny6awmqo"
    ]
];

// Array untuk menyimpan hasil
$results = [];
$multiCurl = curl_multi_init();
$curlArray = [];

foreach ($locations as $location) {
    $curlArray[$location["name"]] = curl_init($location["api_url"]);
    curl_setopt($curlArray[$location["name"]], CURLOPT_TIMEOUT, 10);  // Set max wait time per request
    curl_setopt($curlArray[$location["name"]], CURLOPT_CONNECTTIMEOUT, 5); // Set connection timeout
    curl_setopt($curlArray[$location["name"]], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlArray[$location["name"]], CURLOPT_HTTPHEADER, [
        "X-TOKEN: {$location['api_token']}",
        "Accept: application/json",
        "Authorization: Bearer {$location['api_token']}"
    ]);
    curl_multi_add_handle($multiCurl, $curlArray[$location["name"]]);
}

// Execute all requests simultaneously
$running = null;
do {
    $status = curl_multi_exec($multiCurl, $running);
    if ($status === CURLM_CALL_MULTI_PERFORM) {
        continue;
    }
    curl_multi_select($multiCurl); // Prevent 100% CPU usage
} while ($running);

// Fetch responses
foreach ($locations as $location) {
    $response = curl_multi_getcontent($curlArray[$location["name"]]);
    curl_multi_remove_handle($multiCurl, $curlArray[$location["name"]]);
    curl_close($curlArray[$location["name"]]);

    // Parse response (JSON or fallback to |)
    $data = json_decode($response, true);
    if ($data === null) {
        $data = explode("|", $response);
    }

    $results[] = [
        "id" => $location["id"],
        "name" => $location["name"],
        "total_sales" => $data[1] ?? null, // Pastikan index sesuai
        "current_sales" => $data[2] ?? null,
        "customer_served" => $data[3] ?? null,
        "detail_url" => $location["detail_url"] ?? null
    ];
}

curl_multi_close($multiCurl);

echo json_encode($results, JSON_PRETTY_PRINT);

