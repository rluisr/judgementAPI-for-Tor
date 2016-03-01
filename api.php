<?php
date_default_timezone_set('Asia/Tokyo');
$tor_list = file_get_contents("tornodelist");

$tor_ip = isset($_POST['ip']) ? htmlspecialchars($_POST['ip'], ENT_QUOTES) : "no set IP";
$tor_hostname = gethostbyaddr($tor_ip);

if (strpos($tor_list, $tor_ip) !== false || strpos($tor_hostname, "tor") !== false || preg_match("/[a-zA-Z]/", $tor_hostname) === 0) {
    $tor_result = 0;
} else {
    $tor_result = 1;
}

$json_array = array(
    'ip' => $tor_ip,
    'hostname' => $tor_hostname,
    'result' => $tor_result
);

header("Content-Type: application/json charset=UTF-8");
echo json_encode($json_array);

setCount();



function setCount()
{
    $fp = fopen("count.txt", "r+");
    $count = fgets($fp, 10);
    $count++;
    rewind($fp);
    fputs($fp, $count);
    fclose($fp);
}