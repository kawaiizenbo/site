<?php
    include "last_time.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $pin = "0722";
        if (!isset($_POST["pin"])) die("provide pin..");
        if ($_POST["pin"] != $pin) die("invlaid pin..");
        $lt = time();
        file_put_contents('last_time.php', '<?php $last_time = '.strval($lt). '; ?>');
        header("Location: .");
    }
?>
<html>
    <head>
        <title>you shouldnt be here please leave immediatly</title>
    </head>

    <body style="font-family: monospace;">
        <center>
            <h1 id="time">0</h1>
            <h2>without cutting</h2>
            <span>last cuts</span><br>
            <span id="realTime">0 (our time)</span><br>
            <span id="urTime">0 (your time)</span><br><br>
            <form class="center" action="index.php" method="post">
                <label for="pin">pin</label>
                <input id="pin" type="text" name="pin" style="width: 50px;"><br><br>
                <input type="submit" value="reset time :(">
            </form>
        </center>
        <script>
            var tick;
            var time_last = new Date(parseInt("<?php echo($last_time); ?>")*1000);
            function showTime()
            {
                var time_now = new Date();
                var ms_now = time_now.getTime();
                var ms_last = time_last.getTime();
                var days = Math.ceil(Math.abs(ms_now - ms_last) / (1000 * 60 * 60 * 24)) - 1;
                var hours = Math.ceil(Math.abs(ms_now - ms_last) / (1000 * 60 * 60)) - 1 - (days * 24);
                var minutes = Math.ceil(Math.abs(ms_now - ms_last) / (1000 * 60)) - 1 - (days * 24 * 60) - (hours * 60);
                console.log(time_last.toLocaleString());
                console.log(time_now.toLocaleString());
                var timeSinceString = "";
                if (days == 1) timeSinceString += `${days} day<br>`;
                else if (days > 1) timeSinceString += `${days} days<br>`;
                if (hours == 1) timeSinceString += `${hours} hour<br>`;
                else if (hours > 1) timeSinceString += `${hours} hours<br>`;
                if (minutes == 1) timeSinceString += `${minutes} minute<br>`;
                else if (minutes > 1) timeSinceString += `${minutes} minutes<br>`;
                if (timeSinceString == "") timeSinceString = "0 minutes<br>"
                document.getElementById("time").innerHTML = timeSinceString;
                document.getElementById("realTime").innerHTML = time_last.toLocaleString("en-GB", {timeZone: "America/Phoenix"}) + " (our time)";
                document.getElementById("urTime").innerHTML = time_last.toLocaleString("en-GB") + " (your time)";
            }
            showTime();
            tick = setInterval("showTime()", 60000);
        </script>
    </body>
</html>
