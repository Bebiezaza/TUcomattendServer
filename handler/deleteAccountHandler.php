<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">ลบข้อมูลบัญชีนักเรียน</p>
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

                if($student_user == "")
                {
                    redirectCustom($user, $pass, "ไม่ได้ระบุชื่อผู้ใช้", "", "login_fail", "← ย้อนกลับ");
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
                    
                //delete account
                    $sql = "DELETE FROM student_login WHERE username = $student_user;";

                    //write table
                    work($conn, $sql, "ลบข้อมูลบัญชีนักเรียนสำเร็จ", "ไม่สามารถลบข้อมูลบัญชีนักเรียนได้: ");

                //delete from log
                    $sql2 = "DELETE FROM computer_log WHERE username = $student_user;";

                    //write table
                    work($conn, $sql2, "ลบข้อมูลจากฐานข้อมูลการเข้าใช้คอมพิวเตอร์สำเร็จ", "ไม่สามารถลบข้อมูลจากฐานข้อมูลการเข้าใช้คอมพิวเตอร์ได้: ");
                
                //sql disconnect
                    mysqli_close($conn);

                    redirectCustom($user, $pass, "", "../landing.php", "login", "เสร็จสิ้น →");
                }
            }
            else
            {
?>
                <h2><u>ลบข้อมูลบัญชีนักเรียน</u></h2>
                <form method = "post" autocomplete = "off">
                    <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                    <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                    
                    <label for = "student_user">รหัสนักเรียน:</label><br>
                    <input id = "student_user" type = "text" name = "student_user" value = ""><br><br>

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