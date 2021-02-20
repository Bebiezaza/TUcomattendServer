<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">แก้ไขรหัสผ่านนักเรียน</p>
        </header>

        <center>
<?php
            include('../config.php');
            include('../function/sql.php');

            $user = $_POST["user"];
            $pass = $_POST["pass"];
            
            if(isset($_POST['continue']))
            {
                $student_user = $_POST["student_user"];
                $student_pass = $_POST["student_pass"];
                $student_conf = $_POST["student_conf"];

                if($student_user == "")
                {
                    redirectCustom($user, $pass, "ไม่ได้ระบุชื่อผู้ใช้", "", "login_fail", "← ย้อนกลับ");
                    die;
                }
                else if($student_pass != $student_conf)
                {
                    redirectCustom($user, $pass, "ยืนยันรหัสไม่ผ่าน", "", "login_fail", "← ย้อนกลับ");
                    die;
                }
                else
                {
                    $conn = mysqli_connect($db_host, $db_user, $db_pass);

                //select database
                    selectDB($conn, "$db_name");

                    $db_changepass = "SELECT * FROM student_login where username = '$student_user'";
                    if($row = mysqli_query($conn, $db_changepass))
                    {
                        if (mysqli_num_rows($row) == 0)
                        {
                            redirectCustom($user, $pass, "ไม่มีชื่อผู้ใช้นี้ในระบบ", "", "login_fail", "← ย้อนกลับ");
                            die;
                        }
                    }
                    mysqli_free_result($row);
                    
                //update account password
                    $sql = "UPDATE student_login
                    SET password = MD5('$student_pass')
                    WHERE username = $student_user;";

                    //write table
                    work($conn, $sql, "แก้ไขรหัสผ่านนักเรียนสำเร็จ", "ไม่สามารถแก้ไขรหัสผ่านนักเรียนได้: ");

                //sql disconnect
                    mysqli_close($conn);

                    redirectCustom($user, $pass, "", "../landing.php", "login", "เสร็จสิ้น →");
                }
            }
            else
            {
?>
                <h2><u>แก้ไขรหัสผ่านนักเรียน</u></h2>
                <form method = "post" autocomplete = "off">
                    <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                    <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                    
                    <label for = "student_user">รหัสนักเรียน:</label><br>
                    <input id = "student_user" type = "text" name = "student_user" value = ""><br><br>
                
                    <label for = "student_pass">รหัสผ่าน:</label><br>
                    <input id = "student_pass" type = "password" name = "student_pass" value = ""><br><br>
                    
                    <label for = "student_conf">รหัสผ่านอีกครั้ง:</label><br>
                    <input id = "student_conf" type = "password" name = "student_conf" value = ""><br><br>

                    <input class = "login" type = "submit" name = "continue" value = "ดำเนินการต่อ →">
                </form>
<?php
            }
?>
        </center>

        <footer>
<?php
            redirectCustom($user, $pass, "", "../landing.php", "", "กลับสู่หน้าหลัก");
?>
        </footer>
    </body>
</html>