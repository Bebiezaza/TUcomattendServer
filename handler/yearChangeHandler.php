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
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">เปลี่ยนปีการศึกษา</p>
        </header>
        <body>
<?php
        include('../config.php');
        include('../function/sql.php');
        $conn = mysqli_connect($db_host, $db_user, $db_pass);

        $user = $_POST["user"];
        $pass = $_POST["pass"];

            //select database
            selectDB($conn, "TUcomattend");

        //drop table classrooom_info
        $sql = "DROP TABLE classroom_info;";

            work($conn, $sql, "", "Error Dropping 'classroom_info' Table: ", false);

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
            work($conn, $sql, "<h3>หลังจากเปลี่ยนปีการศึกษาแล้ว อย่าลืมเชื่อมรหัสนักเรียนกับห้องเรียนใหม่ด้วย</h3>", "Error Creating 'classroom_info' Table: ", false);

        //sql disconnect
        mysqli_close($conn);
?>        
        <form method = "post" action = "../landing.php">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <input class = "login" type = "submit" value = "> กลับสู่หน้าเดิม <">
        </form>
</center></body>
</html>