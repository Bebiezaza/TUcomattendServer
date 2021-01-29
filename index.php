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
        <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์</p>
    </header>
    <?php
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
            <label for = "login_name">ชื่อผู้ใช้</label><br>
            <input id = "login_name" type = "text" name = "login_name"><br><br>
            
            <label for = "login_name">รหัสผ่าน</label><br>
            <input id = "login_pass" type = "password" name = "login_pass"><br>
            </div>
            <input class = "login" type = "submit" value = "> เข้าสู่ระบบ <">
        </form></center>
        <?php } ?>

        <footer>
            <a class = "footerlink" href="http://www.triamudom.ac.th">โรงเรียนเตรียมอุดมศึกษา</a>
        </footer>
    </body>
