<?php
include "count.php";
include "bannedIPs.php";

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
if (in_array($host, $bannedIPs)) die('<span style="color: red;">You are banned from this instance!</span>');
if (!isset($_POST['nickname']) || !isset($_POST['body']) || !isset($_POST['image_url'])) die('<span style="color: red;">Did not specify correct POST attributes.<br>Please check if your client is configured properly.</span>');
if (trim(htmlspecialchars($_POST['body'])) == "") die('<span style="color: red;">Did not provide body.</span>');
if (trim(htmlspecialchars($_POST['nickname'])) == "system") die('<span style="color: red;">You cannot use that nickname.</span>');

$image_url = trim($_POST['image_url']);
$body = trim(htmlspecialchars($_POST['body']));
$nickname = 'anon';
if (trim(htmlspecialchars($_POST['nickname'])) !== "") $nickname = trim(htmlspecialchars($_POST['nickname']));

$posts = json_decode(file_get_contents('posts.json'), true);

$post = array("id"=>$count, "ip"=>$host, "time"=>date('Y-m-d\TH:i\Z'), "nickname"=>$nickname, "body"=>$body, "image_url"=>$image_url);

array_unshift($posts['messages'], $post);
file_put_contents('posts.json', json_encode($posts));

$count += 1;
file_put_contents('count.php', '<?php $count = '.strval($count).'; ?>');
header('Location: .');
?>
