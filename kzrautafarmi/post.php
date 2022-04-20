<?php
include "number.php";
if (!isset($_POST["name"]) || !isset($_POST["msg"])) die("invalid");

$nick = "anon";
if ($_POST["name"] !== "") $nick = $_POST["name"];
$msg = "<span style='color: #2c49c9;'>" . $number . "</span> <span style='color: #1c8757;'>" . htmlspecialchars($nick) . "</span> <span style='color: #727272;'>";
$msg .= date("Y/m/d H:i:s") . "</span>\n";
$msg .= htmlspecialchars($_POST["msg"]) . "\n";
$msglen = strlen($msg);

$x = fopen("messages.txt", "r+");
fseek($x, 0, SEEK_END);
$size = ftell($x);
fwrite($x, str_repeat("X", $msglen));
for ($z = 0; $z < $size; $z += 1) {
    $i = ($size - $z - 1);
    fseek($x, $i);
    $c = fread($x, 1);
    fseek($x, $i + $msglen);
    fwrite($x, $c);
}
fseek($x, 0);
fwrite($x, $msg);
fclose($x);

$number += 1;
file_put_contents("number.php", "<?php \$number = " . strval($number) . ";");
header("Location: .");
?>
