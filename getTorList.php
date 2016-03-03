<?php
/**
 * OK : PHP5.4.16
 * NG : PHP7
 *
 * Why?
 */
$url = "https://www.dan.me.uk/torlist/";

$headers = array(
    "HTTP/1.1",
    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
    "Accept-Encoding: gzip, deflate, sdch",
    "Accept-Language: ja,en-us;q=0.7,en;q=0.3",
    "cache-control: max-age=0",
    "Connection: keep-alive",
    "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:26.0) Gecko/20100101 Firefox/26.0"
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$html = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

print_r($html);

if ($code === "403") { die(); }

file_put_contents("tornodelist", $html);