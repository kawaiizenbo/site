<?php
    $myfile = fopen("messages.json", "r") or die('{"error":0}');
    echo '{'.fread($myfile,filesize("messages.txt"));
    fclose($myfile);
>
