<?php
    $pin = "0722";
    if (!isset($_POST["pin"])) die("provide pin..");
    if ($_POST["pin"] != $pin) die("invlaid pin..");
    $lt = time();
    file_put_contents('last_time.php', '<?php $last_time = '.strval($lt). '; ?>');
    header("Location: .");
?>
