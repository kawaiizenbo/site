<?php
require_once "connection.php";
$username = $old_password = $new_password = $confirm_new_password = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty(trim($_POST["username"])))
    {
        die(3);
    }
    $username = trim($_POST["username"]);
    if (empty(trim($_POST["old_password"])))
    {
        die(6);
    }
    $old_password = trim($_POST["old_password"]);
    if (empty(trim($_POST["new_password"])))
    {
        die(6); 
    } 
    elseif (strlen(trim($_POST["new_password"])) < 6)
    {
        die(7);
    } 
    $new_password = trim($_POST["new_password"]);
    if (empty(trim($_POST["confirm_new_password"])))
    {
        die(8);
    } 
    $confirm_new_password = trim($_POST["confirm_new_password"]);
    if (empty($new_password_err) && ($new_password != $confirm_new_password))
    {
        die(9);
    }

    $sql = "UPDATE users SET password = ? WHERE username = ? AND password = ?";
    if ($stmt = mysqli_prepare($link, $sql))
    {
        mysqli_stmt_bind_param($stmt, "sss", $param_new_password, $param_username, $param_old_password);
        $param_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $param_username = $username;
        $param_old_password = password_hash($old_password, PASSWORD_DEFAULT);
        if (mysqli_stmt_execute($stmt))
        {
            // do nothing
        } 
        else
        {
            die(2);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    die(0);
}
?>
