<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">เปลี่ยนปีการศึกษา</p>
        </header>

        <center>
<?php
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            if(isset($_POST['continue']))
            {
                include('../config.php');
                include('../function/sqlHelper.php');
                include('../function/formHelper.php');
                $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //select database
                selectDB($conn, "$db_name");

            //drop table classrooom_info
                $sql = "DROP TABLE classroom_info;";

                work($conn, $sql, "", "เกิดปัญหาระหว่างการเปลี่ยนปีการศึกษา: ");

            //create classroom_info table
                //class number loop
                $class_no = "";
                for ($i=1; $i<=50; $i++)
                {
                    $class_no = $class_no . "student_" . $i . " int(5),";
                }

                $sql = "CREATE TABLE classroom_info( 
                    classroom int(3),
                    $class_no
                    primary key(classroom));";

                    //create table
                    work($conn, $sql, "<h3>หลังจากเปลี่ยนปีการศึกษาแล้ว อย่าลืมเชื่อมรหัสนักเรียนกับห้องเรียนใหม่ด้วย</h3>", "เกิดปัญหาระหว่างการเปลี่ยนปีการศึกษา: ");

                //sql disconnect
                mysqli_close($conn);

                redirectCustom($user, $pass, "", "../landing.php", "login", "เสร็จสิ้น →");
            }
            else
            {
?>
                <h1><font color="red"><br>คำเตือน: การเริ่มปีการศึกษาใหม่ไม่สามารถย้อนกลับได้ <br> คุณต้องการทำต่อหรือไม่?</font></h1><br><br>
                <form method = "post" action = "../landing.php">
                    <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                    <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                    <input class = "login_fail" type = "submit" value = "← ย้อนกลับ">
                </form>
                <form method = "post">
                    <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                    <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                    <input class = "login" type = "submit" name = "continue" value = "ดำเนินการต่อ →">
                </form>
<?php
            }
?>
        </center>
    </body>
</html>