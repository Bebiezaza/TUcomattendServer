<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

        <link href="theme.css" rel="stylesheet"/>
        
<style>
    @font-face {
        font-family: Kanit;
        src: url(../fonts/Kanit-Regular.ttf)
    }
</style>
    </head>

    <body>
    <center><header>
        <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png"> ติดตั้งระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ <IMG id = "TUlogo" src = "pictures/mw-loader.gif"></p>
        <hr>
        
    </header>
<?php
        if(isset($_POST['continue3']))
        {
            $admin_user = $_POST["admin_user"];
            $admin_pass = $_POST["admin_pass"];
            $admin_conf = $_POST["admin_conf"];

            if($admin_pass != $admin_conf)
            {
?>
                <form method = 'post' name = 'continue2' action = 'index.php'>
                    <input type = 'submit' value = '← ย้อนกลับ'>
                </form>
<?php
                die;
            }
            else
            {
                include('../config.php');
                include('function/sql.php');
                
                $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //check connection
                if (!$conn)
                {
                    echo "<h1>Connection Failed: " . mysqli_connect_error() . "</h1><br>";
                }

            //select database
                selectDB($conn, "TUcomattend");
                
            //add default admin login
                $sql = "INSERT INTO admin_login
                VALUES ('$admin_user', '$admin_pass');";

                //write table
                work($conn, $sql, "Data Written to Table 'admin_login' Successfully", "Error Writing Data to Table: ", true, "");

            //sql disconnect
                mysqli_close($conn);
?>
            <form method = "post" action = "../index.php">
                <input type = "submit" value = "เสร็จสิ้น →">
            </form>
<?php
            }
        }
        elseif(isset($_POST['continue2']))
        {
?>          <h2><u>เพิ่มผู้ดูแลระบบเริ่มต้น</u></h2>
            <form method = "post" autocomplete = "off">
                <label for = "admin_user">ชื่อผู้ใช้ของคุณ:
                <sup><a href="help.html#ชื่อผู้ใช้ของคุณ" target="_blank"> การช่วยเหลือ</a></sup></label><br>
                <input id = "admin_user" type = "text" name = "admin_user" value = ""><br><br>
            
                <label for = "admin_pass">รหัสผ่าน:</label><br>
                <input id = "admin_pass" type = "password" name = "admin_pass" value = ""><br><br>
                
                <label for = "admin_conf">รหัสผ่านอีกครั้ง:</label><br>
                <input id = "admin_conf" type = "password" name = "admin_conf" value = ""><br><br>

                <input type = "submit" name = "continue3" value = "ดำเนินการต่อ →">
            </form>
<?php
        }
        elseif(isset($_POST['continue1']))
        {
            include('function/sql.php');

            $db_host = $_POST["db_host"];
            $db_user = $_POST["db_user"];
            $db_pass = $_POST["db_pass"];

            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //check connection
            if (!$conn)
            {
                echo "<h1>Connection Failed: " . mysqli_connect_error() . "</h1><br>";
            }

        //create tucomattend database
            $sql = "CREATE DATABASE TUcomattend COLLATE utf8_general_ci;";
            work($conn, $sql, "Database 'TUcomattend' Created Successfully", "Error Creating Database: ", true, "");

        //select database
            selectDB($conn, "TUcomattend");

        //create admin_login table
            $sql = "CREATE TABLE admin_login( 
            username varchar(20), 
            password varchar(16), 
            primary key(username));";

            //create table
            work($conn, $sql, "Table 'admin_login' Created Successfully", "Error Creating Table: ", true, "");
            
        //create student_login table
        $sql = "CREATE TABLE student_login( 
            username varchar(5), 
            password varchar(16),
            birthday varchar(10), 
            primary key(username));";

            //create table
            work($conn, $sql, "Table 'student_login' Created Successfully", "Error Creating Table: ", true, "");
            
        //sql disconnect
            mysqli_close($conn);

            $mainConfig = fopen("../config.php", "w");
                fwrite($mainConfig, "<?php\n");
                
                fwrite($mainConfig, "## Database settings\n");
                
                fwrite($mainConfig, "$");
                fwrite($mainConfig, "db_host = '");
                fwrite($mainConfig, "$db_host';\n");
                
                fwrite($mainConfig, "$");
                fwrite($mainConfig, "db_user = '");
                fwrite($mainConfig, "$db_user';\n");

                fwrite($mainConfig, "$");
                fwrite($mainConfig, "db_pass = '");
                fwrite($mainConfig, "$db_pass';\n");
                
            fclose($mainConfig);
?>
            <form method = "post">
                <input type = "submit" name = "continue2" value = "ดำเนินการต่อ →">
            </form>
<?php
        }
        else
        {
            $mainConfig = fopen("../config.php", "w")
?>
            <h2><u>เชื่อมต่อไปยังฐานข้อมูล</u></h2>
            <form method = "post" autocomplete = "off">
                <label for = "db_host">โฮสต์ฐานข้อมูล:
                <sup><a href="help.html#โฮสต์ฐานข้อมูล" target="_blank"> การช่วยเหลือ</a></sup></label><br>
                <input id = "db_host" type = "text" name = "db_host" value = "localhost"><br><br>
            
                <label for = "db_user">ชื่อผู้ใช้ฐานข้อมูล:
                <sup><a href="help.html#ชื่อผู้ใช้ฐานข้อมูล" target="_blank"> การช่วยเหลือ</a></sup></label><br>
                <input id = "db_user" type = "text" name = "db_user" value = "root"><br><br>
                
                <label for = "db_pass">รหัสฐานข้อมูล:
                <sup><a href="help.html#รหัสฐานข้อมูล" target="_blank"> การช่วยเหลือ</a></sup></label><br>
                <input id = "db_pass" type = "password" name = "db_pass" value = ""><br><br>

                <input type = "submit" name = "continue1" value = "ดำเนินการต่อ →">
            </form>

<?php
        }
?>

    </center>

        <footer>
            <a class = "footerlink" href="http://www.triamudom.ac.th">โรงเรียนเตรียมอุดมศึกษา</a>
        </footer>
    </body>
