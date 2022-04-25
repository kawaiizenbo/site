<?php
    $myfile = fopen("messages.json", "r") or die('{"error":0}');
    echo '{"messages":['.fread($myfile,filesize("messages.json"));
    fclose($myfile);
?>
