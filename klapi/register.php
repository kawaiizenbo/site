<?php
require_once "connection.php";
$username = $password = $confirm_password = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty(trim($_POST["username"])))
    {
        die(3);
    } 
    elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
    {
        die(4);
    } 
    else
    {
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($link, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if (mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);  
                if (mysqli_stmt_num_rows($stmt) == 1)
                {
                    die(5);
                } 
                else
                {
                    $username = trim($_POST["username"]);
                }
            } 
            else
            {
                die(2);
            }
            mysqli_stmt_close($stmt);
        }
    }
    if (empty(trim($_POST["password"])))
    {
        die(6);     
    } 
    elseif (strlen(trim($_POST["password"])) < 6)
    {
        die(7);
    } 
    $password = trim($_POST["password"]);
    if (empty(trim($_POST["confirm_password"])))
    {
        die(8);   
    } 
    $confirm_password = trim($_POST["confirm_password"]);
    if ($password != $confirm_password)
    {
        die(9);
    }

    $sql = "INSERT INTO accounts (username, password) VALUES (?, ?)";
         
    if ($stmt = mysqli_prepare($link, $sql))
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
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
