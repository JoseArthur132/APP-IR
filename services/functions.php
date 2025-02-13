<?php
function send_command($ip, $data)
{
    $client = curl_init();

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $url = "http://" . $ip;

    if (!empty($data)) {
        $url .= $data;
    }

    //POST

    // curl_setopt($client, CURLOPT_POSTFIELDS, $data);

    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);
    return json_decode($response, true);
}