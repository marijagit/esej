<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://covid-193.p.rapidapi.com/statistics?country=Serbia",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-rapidapi-host: covid-193.p.rapidapi.com",
        "x-rapidapi-key: 8ee92b7600mshedf53173b69e36ep18ebbejsnc86653177fc8"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}