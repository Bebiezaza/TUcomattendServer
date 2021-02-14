<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>
    
<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">เชื่อมโยงคอมพิวเตอร์กับไอพี</p>
        </header>
        
        <center>
<?php
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            if(isset($_POST["continue"]))
            {
                include('../config.php');
                include('../function/sql.php');

                $com_name = $_POST["com_name"];
                $com_ip = $_POST["com_ip"];

                $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //select database
                selectDB($conn, "$db_name");
                    
            //add computer info
                $sql = "INSERT INTO computer_select
                VALUES ('$com_name', '$com_ip');";

                //write table
                work($conn, $sql, "เพิ่มคอมพิวเตอร์สำเร็จ <br><br> <font size=6><b>ข้อมูลคือ</b></font> <br> ชื่อคอมพิวเตอร์: $com_name <br> ไอพีคอมพิวเตอร์: $com_ip", "มีปัญหาในระหว่างการเพิ่มคอมพิวเตอร์: ");

            //sql disconnect
                mysqli_close($conn);

                redirectCustom($user, $pass, "", "../landing.php", "login", "> กลับสู่หน้าเดิม <");
                die;
            }
            else
            {
?>
                <form method = "post" autocomplete = "off">
                    <div class = "login">
                        <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                        <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                        <label for = "com_name">ชื่อของคอมพิวเตอร์: </label><br>
                        <input id = "com_name" type = "text" name = "com_name"><br>
                        <label for = "com_ip">ไอพีของคอมพิวเตอร์: </label><br>
                        <input id = "com_ip" type = "text" name = "com_ip"><br>
                    </div>

                    <input class = "login" type = "submit" name = "continue" value = "> เพิ่มคอมพิวเตอร์ <">
                </form>
<?php
            }
?>
        </center>
    </body>
</html>
