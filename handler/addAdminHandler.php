<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>
    
<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">เพิ่มผู้ดูแลระบบ</p>
        </header>

        <center>
<?php
            include('../config.php');
            include('../function/sql.php');
            
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            
            if(isset($_POST['continue']))
            {
                $admin_user = $_POST["admin_user"];
                $admin_pass = $_POST["admin_pass"];
                $admin_conf = $_POST["admin_conf"];

                if($admin_user == "")
                {
                    redirectCustom($user, $pass, "ไม่ได้ระบุชื่อผู้ใช้", "../landing.php", "login_fail", "← ย้อนกลับ");
                }
                else if($admin_pass != $admin_conf)
                {
                    redirectCustom($user, $pass, "ยืนยันรหัสไม่ผ่าน", "../landing.php", "login_fail", "← ย้อนกลับ");
                }
                else
                {
                    $conn = mysqli_connect($db_host, $db_user, $db_pass);

                //select database
                    selectDB($conn, "$db_name");
                    
                //add admin login
                    $sql = "INSERT INTO admin_login
                    VALUES ('$admin_user', MD5('$admin_pass'));";

                    //write table
                    work($conn, $sql, "เพิ่มผู้ดูแลระบบสำเร็จ", "ไม่สามารถเพิ่มผู้ดูแลระบบได้: ");

                //sql disconnect
                    mysqli_close($conn);

                    redirectCustom($user, $pass, "", "../landing.php", "login", "เสร็จสิ้น →");
                }
            }
            else
            {
?>
                <h2><u>เพิ่มผู้ดูแลระบบ</u></h2>
                <form method = "post" autocomplete = "off">
                    <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                    <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                    
                    <label for = "admin_user">ชื่อผู้ใช้ของคุณ:</label><br>
                    <input id = "admin_user" type = "text" name = "admin_user" value = ""><br><br>
                
                    <label for = "admin_pass">รหัสผ่าน:</label><br>
                    <input id = "admin_pass" type = "password" name = "admin_pass" value = ""><br><br>
                    
                    <label for = "admin_conf">รหัสผ่านอีกครั้ง:</label><br>
                    <input id = "admin_conf" type = "password" name = "admin_conf" value = ""><br><br>

                    <input class = "login" type = "submit" name = "continue" value = "ดำเนินการต่อ →">
                </form>
<?php
            }
?>
        </center>
    </body>
</html>