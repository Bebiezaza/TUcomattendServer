<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>
    </head>
    <link href="../css/theme.css" rel="stylesheet"/>
        
<style>
    @font-face {
        font-family: Kanit;
        src: url(../fonts/Kanit-Regular.ttf)
    }
</style>

    <body><center>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">เพิ่มผู้ดูแลระบบ</p>
        </header>
        <body>
<?php
        if(isset($_POST['continue']))
        {
            $admin_user = $_POST["admin_user"];
            $admin_pass = $_POST["admin_pass"];
            $admin_conf = $_POST["admin_conf"];

            if($admin_user == "")
            {
                echo "ไม่ได้ระบุชื่อผู้ใช้";
?>
                <form method = 'post' name = 'continue2' action = 'index.php'>
                    <input type = 'submit' value = '← ย้อนกลับ'>
                </form>
<?php
            }
            else if($admin_pass != $admin_conf)
            {
                echo "ยืนยันรหัสไม่ผ่าน";
?>
                <form method = 'post' name = 'continue2' action = 'index.php'>
                    <input type = 'submit' value = '← ย้อนกลับ'>
                </form>
<?php
                die;
            }
            else
            {
                include('../config.php');
                include('../function/sql.php');
                
                $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //check connection
                if (!$conn)
                {
                    echo "<h1>Connection Failed: " . mysqli_connect_error() . "</h1><br>";
                }

            //select database
                selectDB($conn, "$db_name");
                
            //add admin login
                $sql = "INSERT INTO admin_login
                VALUES ('$admin_user', MD5('$admin_pass'));";

                //write table
                work($conn, $sql, "เพิ่มผู้ดูแลระบบสำเร็จ", "ไม่สามารถเพิ่มผู้ดูแลระบบได้: ", true, "");

            //sql disconnect
                mysqli_close($conn);
?>
            <form method = "post" action = "../index.php">
                <input class = "login" type = "submit" value = "เสร็จสิ้น →">
            </form>
<?php
            }
        }
        else
        {
?>          <h2><u>เพิ่มผู้ดูแลระบบ</u></h2>
            <div class = "login"><form method = "post" autocomplete = "off">
                <label for = "admin_user">ชื่อผู้ใช้ของคุณ:</label><br>
                <input id = "admin_user" type = "text" name = "admin_user" value = ""><br><br>
            
                <label for = "admin_pass">รหัสผ่าน:</label><br>
                <input id = "admin_pass" type = "password" name = "admin_pass" value = ""><br><br>
                
                <label for = "admin_conf">รหัสผ่านอีกครั้ง:</label><br>
                <input id = "admin_conf" type = "password" name = "admin_conf" value = ""><br><br>

                <input class = "login" type = "submit" name = "continue" value = "ดำเนินการต่อ →">
            </form></div>
<?php
        }
?>
    </center></body>
</html>