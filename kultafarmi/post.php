<?php
include "number.php";

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
$banned_ips = array("0.0.0.0");
$host = getUserIpAddr();
if(in_array($host, $banned_ips))
{
    die("You are banned from this instance!");
}
if (!isset($_POST["name"]) || !isset($_POST["msg"])) die("invalid");

$nick = "anon";
if ($_POST["name"] !== "") $nick = $_POST["name"];
$msg = "<span style='color: #2c49c9;'>" . $number . "</span> <span style='color: #1c8757;'>" . htmlspecialchars($nick) . "</span> <span style='color: #727272;'>";
$msg .= date("Y/m/d H:i:s") . "</span>\n";
$msg .= htmlspecialchars($_POST["msg"]) . "\n";
$msglen = strlen($msg);

$x = fopen("messages.txt", "r+");
$tr = $msg.fread($myfile,filesize("messages.txt");
fwrite($x, $tr);
fclose($x);

$number += 1;
file_put_contents("number.php", "<?php \$number = " . strval($number) . ";");
header("Location: .");
?>
