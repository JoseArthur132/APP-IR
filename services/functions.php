<?php
function send_command($ip, $data)
{
    $client = curl_init();

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $url = $ip;

    if (!empty($data)) {
        $url .= "&" . http_build_query($data);
    }

    // if ($method == "POST") {
    //     $variables = array_merge(["endpoint" => $endpoint], $variables);

    //     curl_setopt($client, CURLOPT_POSTFIELDS, $variables);
    // }
    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);
    return json_decode($response, true);
}
