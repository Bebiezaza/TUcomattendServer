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

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์</p>
        </header>
        <body><center>
<?php
        include('../config.php');
        include('../function/sql.php');

        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $com_name = $_POST["com_name"];

    if(!$com_name == "")
    {
        $conn = mysqli_connect($db_host, $db_user, $db_pass);
        
        selectDB($conn, "TUcomattend");

        $db_com_name = mysqli_query($conn, "SELECT com_ip FROM computer_select where com_name = '$com_name'"); 
        while($row = mysqli_fetch_array($db_com_name)) 
        { 
            $com_ip = $row['com_ip']; 
        }

        $data = mysqli_query($conn, "SELECT * FROM computer_log where com_ip = '$com_ip' ORDER BY `computer_log`.`datetime` DESC"); 
        echo"<font face='monospaced'><table border cellpadding=5>"; 
        echo "<tr>";
        echo "<th>Date-Time</th><th>Computer IP</th><th>Username</th></tr>";
        while($row= mysqli_fetch_array( $data ))
        { 
            echo "<tr><td>" . $row['datetime'] . "</td><td>" . $row['com_ip'] . "</td><td>" . $row['username'] . "</td></tr>";
        } 
        echo"</table></font>";

        //sql disconnect
        mysqli_close($conn);
    }
    else
    {
        echo "<h3>ไม่ได้มีการเลือกคอมพิวเตอร์</h3>";
    }
?>
        <br><form method = "post" action = "../landing.php">
            <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
            <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
            <input class = "login" type = "submit" value = "> กลับสู่หน้าเดิม <">
        </form>
    </center></body>
</html>