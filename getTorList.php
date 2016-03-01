<?php

$tor = file_get_contents("https://www.dan.me.uk/torlist/");
file_put_contents("tornodelist", $tor);