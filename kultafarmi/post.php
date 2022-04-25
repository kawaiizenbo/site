<?php
include "count.php";
include "banned_ips.php";

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

$host = getUserIpAddr();
if(in_array($host, $banned_ips))
{
    die("You are banned from this instance!");
}
if (!isset($_POST["name"]) || !isset($_POST["msg"])) die("Did not specify nickname or message POST attributes");

$nick = "anon";
if ($_POST["name"] !== "") $nick = $_POST["name"];

// legacy mode
$msg = '<span style="color: #2c49c9;">'.$count.'</span> <span style="color: #1c8757;">'.htmlspecialchars($nick).'</span> <span style="color: #727272;">'.date("Y/m/d H:i:s")."</span>\n".htmlspecialchars($_POST["msg"])."\n";

$tw = $msg.file_get_contents("messages.txt");
file_put_contents("messages.txt", $tw);

// updated json mode
$json_msg = '{"id":'.$count.',"nickname":"'.htmlspecialchars($nick).'","content":"'.htmlspecialchars($_POST["msg"]).'","time":"'.date('Y-m-d\TH:i\Z').'","operator":false,"host":"'.$host.'"},';

$tw = $json_msg.file_get_contents("messages.json");
file_put_contents("messages.json", $tw);

$count += 1;
file_put_contents("count.php", "<?php \$count = ".strval($count)."; ?>");
header("Location: .");
?>
