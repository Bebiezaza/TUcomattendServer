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
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">เชื่อมโยงคอมพิวเตอร์กับไอพี</p>
        </header>
        <body>
<?php
        include('../config.php');
        include('../function/sql.php');
        $conn = mysqli_connect($db_host, $db_user, $db_pass);

        $user = $_POST["user"];
        $pass = $_POST["pass"];

        if(isset($_POST["continue"]))
        {
            $com_name = $_POST["com_name"];
            $com_ip = $_POST["com_ip"];

            //select database
            selectDB($conn, "$db_name");
                
            //add computer info
                $sql = "INSERT INTO computer_select
                VALUES ('$com_name', '$com_ip');";

                //write table
                work($conn, $sql, "เพิ่มคอมพิวเตอร์สำเร็จ <br><br> <font size=6><b>ข้อมูลคือ</b></font> <br> ชื่อคอมพิวเตอร์: $com_name <br> ไอพีคอมพิวเตอร์: $com_ip", "มีปัญหาในระหว่างการเพิ่มคอมพิวเตอร์: ", false);

            //sql disconnect
                mysqli_close($conn);
?>
            <form method = "post" action = "../landing.php">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <input class = "login" type = "submit" value = "> กลับสู่หน้าเดิม <">
            </form>
<?php
        }
        else
        {
?>
            <div class = "login"><form method = "post" autocomplete = "off">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <label for = "com_name">ชื่อของคอมพิวเตอร์: </label><br>
                <input id = "com_name" type = "text" name = "com_name"><br>
                <label for = "com_ip">ไอพีของคอมพิวเตอร์: </label><br>
                <input id = "com_ip" type = "text" name = "com_ip"><br>
                </div>
                <input class = "login" type = "submit" name = "continue" value = "> เพิ่มคอมพิวเตอร์ <">
            </form>
<?php } ?>
    </center></body>
</html>