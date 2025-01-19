<?php

require_once(dirname(__FILE__) . "./config.php");

function send_request($endpoint, $method = "GET", $variables = [])
{

    //initiate the curl client
    $client = curl_init();

    //return the results as a string
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    //defines the url

    $url = API_URL;

    //if request is GET

    if ($method == "GET") {
        $url .= "?endpoint=$endpoint";
        if (!empty($variables)) {
            $url .= "&" . http_build_query($variables);
        }
    }

    //if request is POST

    if ($method == "POST") {
        $variables = array_merge(["endpoint" => $endpoint], $variables);

        curl_setopt($client, CURLOPT_POSTFIELDS, $variables);
    }
    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);
    return json_decode($response, true);
}
