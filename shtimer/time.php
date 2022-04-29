<?php
    $pin = "0722"
    if (!isset($_POST["name"])) die("provide pin..")
    if ($_POST["name"] != $pin) die("invlaid pin..")
    $lt = time();
    file_put_contents('last_time.php', '<?php $last_time = '.strval($lt). '; ?>')
    header("Location: .");
?>