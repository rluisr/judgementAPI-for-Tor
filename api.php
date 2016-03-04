<?php
date_default_timezone_set('Asia/Tokyo');

$memcache = new Memcached();
$memcache->addServer('localhost', 11211);

$tor_list = file_get_contents("tornodelist");
$memcache->set('key', $tor_list, 0);

$tor_ip = isset($_POST['ip']) ? htmlspecialchars($_POST['ip'], ENT_QUOTES) : "no set IP";
$tor_hostname = gethostbyaddr($tor_ip);

if (strpos($memcache->get('key'), $tor_ip) !== false || strpos($tor_hostname, "tor") !== false || preg_match("/[a-zA-Z]/", $tor_hostname) === 0) {
    $tor_result = 0;
} else {
    $tor_result = 1;
}

$json_array = array(
    'result' => $tor_result
);

header("Content-Type: application/json charset=UTF-8");
echo json_encode($json_array);

?>