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
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">แก้ไขรหัสผ่านนักเรียน</p>
        </header>
        <body>
<?php
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        
        if(isset($_POST['continue']))
        {
            $student_user = $_POST["student_user"];
            $student_pass = $_POST["student_pass"];
            $student_conf = $_POST["student_conf"];

            if($student_user == "")
            {
                echo "ไม่ได้ระบุชื่อผู้ใช้";
?>
                <form method = 'post' name = 'continue2' action = '../landing.php'>
                    <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                    <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                    <input class = "login" type = 'submit' value = '← ย้อนกลับ'>
                </form>
<?php
            }
            else if($student_pass != $student_conf)
            {
                echo "ยืนยันรหัสไม่ผ่าน";
?>
                <form method = 'post' name = 'continue2' action = '../landing.php'>
                    <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                    <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                    <input class = "login" type = 'submit' value = '← ย้อนกลับ'>
                </form>
<?php
                die;
            }
            else
            {
                include('../config.php');
                include('../function/sql.php');
                
                $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //select database
                selectDB($conn, "$db_name");

                $db_changepass = "SELECT * FROM student_login where username = '$student_user'";
                if($row = mysqli_query($conn, $db_changepass)) 
                {
                    if (mysqli_num_rows($row) == 0)
                    {
?>
                        ไม่มีชื่อผู้ใช้นี้ในระบบ
                        <form method = post>
                            <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                            <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>

                            <input class = "login_fail" type = submit value = "← ย้อนกลับ">
                        </form>
<?php
                        die;
                    }
                }
                mysqli_free_result($row);

            //check connection
                if (!$conn)
                {
                    echo "<h1>Connection Failed: " . mysqli_connect_error() . "</h1><br>";
                }
                
            //add admin login
            //UPDATE `student_login` SET `password` = MD5('yes') WHERE `student_login`.`username` = 2;
                $sql = "UPDATE student_login
                SET password = MD5('$student_pass')
                WHERE student_login.username = $student_user;";

                //write table
                work($conn, $sql, "แก้ไขรหัสผ่านนักเรียนสำเร็จ", "ไม่สามารถแก้ไขรหัสผ่านนักเรียนได้: ", false, "");

            //sql disconnect
                mysqli_close($conn);
?>
            <form method = "post" action = "../landing.php">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <input class = "login" type = "submit" value = "เสร็จสิ้น →">
            </form>
<?php
            }
        }
        else
        {
?>          <h2><u>แก้ไขรหัสผ่านนักเรียน</u></h2>
            <form method = "post" autocomplete = "off">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                
                <label for = "student_user">รหัสนักเรียนของคุณ:</label><br>
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
    <footer>
        <form method = post action = "index.php">
            <input type = "submit" value = "กลับสู่หน้าหลัก">
        </form>
    </footer>
    </center></body>
</html>