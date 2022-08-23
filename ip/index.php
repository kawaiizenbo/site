<?php

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$txt = "{\"ip\":\"".getUserIpAddr()."\",\"user-agent\":\"".$_SERVER['HTTP_USER_AGENT']."\"}\n";
print($txt);

$myfile = fopen("log.txt", "a") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);

if ($_GET['redir_url'] != null)
{
    header('Location: '.$_GET['redir_url'].'');
}
else
{
    header('Location: http://kawaiizenbo.me:8080');
}

?>
