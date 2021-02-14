<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ ทั้งหมด</p>
        </header>
        
        <center>
<?php
            include('../config.php');
            include('../function/sql.php');
            
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            selectDB($conn, "$db_name");

            $data = mysqli_query($conn, "SELECT * FROM computer_log ORDER BY `computer_log`.`datetime` DESC");
            echo"<font face = 'monospaced'><table border cellpadding = 5>"; 
            echo "<tr>";
            echo "<th>Date-Time</th><th>Computer IP</th><th>Username</th></tr>";
            while($row = mysqli_fetch_array($data))
            { 
                echo "<tr><td>" . $row['datetime'] . "</td><td>" . $row['com_ip'] . "</td><td>" . $row['username'] . "</td></tr>";
            }
            mysqli_free_result($data);
            echo"</table></font>";

            //sql disconnect
            mysqli_close($conn);
?>
            <br>
            <form method = "post" action = "../landing.php">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <input class = "login" type = "submit" value = "> กลับสู่หน้าเดิม <">
            </form>
        </center>
    </body>
</html>