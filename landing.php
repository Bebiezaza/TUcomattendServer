<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>Login Passthrough Test</title>
    </head>
    <link href="css/theme.css" rel="stylesheet"/>
        
<style>
    @font-face {
        font-family: Kanit;
        src: url(fonts/Kanit-Regular.ttf)
    }
</style>

    <header>
        <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์</p>
    </header>

    <body><center>
        <?php
            $dbuser = $_POST["username"];
            $dbpass = $_POST["password"];

            $user = $_POST["login_name"];
            $pass = $_POST["login_pass"];

            echo "DB USERNAME: " . $dbuser;
            echo "<br>DB PASSWORD: ". $dbpass;
            echo "<br>USERNAME: " . $user;
            echo "<br>PASSWORD: ". $pass;
        ?>