<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

        <link href="css/theme.css" rel="stylesheet"/>
        
<style>
    @font-face {
        font-family: Kanit;
        src: url(fonts/Kanit-Regular.ttf)
    }
</style>
    </head>

    <body>
    <header>
        <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ BETA</p>
    </header>
    <?php
        error_reporting(0);
        include('config.php');

        $conn = mysqli_connect($db_host, $db_user, $db_pass);

        if (!mysqli_select_db($conn, "TUCOMATTEND"))
        {
            ?>
            <center><form method = "post" action = "config/index.php" autocomplete = "off">
                <input class = "login" type = "submit" value = "> ตั้งค่าฐานข้อมูล <">
            </form></center>
            <?php
        }
        else
        {
    ?>

        <center><div class = "login"><form method = "post" action = "landing.php" autocomplete = "off">
            <input type = "hidden" type = "text" name = "homesubmit" value = "true">
            <label for = "user">ชื่อผู้ใช้</label><br>
            <input id = "user" type = "text" name = "user"><br><br>
            
            <label for = "pass">รหัสผ่าน</label><br>
            <input id = "pass" type = "password" name = "pass"><br>
            </div>
            <input class = "login" type = "submit" value = "> เข้าสู่ระบบ <">
        </form></center>
        <?php } ?>

        <footer>
            <a class = "footerlink" href="http://www.triamudom.ac.th">โรงเรียนเตรียมอุดมศึกษา</a>
        </footer>
    </body>
</html>