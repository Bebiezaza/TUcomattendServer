<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ BETA</p>
        </header>

        <center>
<?php
            error_reporting(0);

            include('config.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            if (!mysqli_select_db($conn, "$db_name"))
            {
?>
                <form method = "post" action = "config/index.php" autocomplete = "off">
                    <input class = "login" type = "submit" value = "> ตั้งค่าฐานข้อมูล <">
                </form>
<?php
            }
            else
            {
?>
            <form method = "post" action = "landing.php" autocomplete = "off">
                <div class = "login">
                    <input type = "hidden" type = "text" value = "true">
                    <label for = "user">ชื่อผู้ใช้</label><br>
                    <input id = "user" type = "text" name = "user"><br><br>
                    
                    <label for = "pass">รหัสผ่าน</label><br>
                    <input id = "pass" type = "password" name = "pass"><br>
                </div>
                <input class = "login" type = "submit" name = "homesubmit" value = "> เข้าสู่ระบบ <">
            </form>
<?php
            }
?>
        </center>
        <footer>
            <a class = "footerlink" href="http://www.triamudom.ac.th">โรงเรียนเตรียมอุดมศึกษา</a>
        </footer>
    </body>
</html>