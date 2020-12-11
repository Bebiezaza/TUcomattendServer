<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ตั้งค่าฐานข้อมูล</title>
    </head>
    <link href="css/theme.css" rel="stylesheet"/>
        
<style>
    @font-face {
        font-family: Kanit;
        src: url(fonts/Kanit-Regular.ttf)
    }
</style>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์</p>
        </header>

        <?php
            include('globalvar.inc');
            include('function/sql.php');
            $conn = mysqli_connect($sql_server, $sql_username, $sql_password);

        //check connection
            if (!$conn)
            {
                echo "<h1>Connection Failed: " . mysqli_connect_error() . "</h1><br>";
            }
            
        //create tucomattend database
            $sql = "CREATE DATABASE TUcomattend COLLATE utf8_general_ci;";
            work($conn, $sql, "Database 'TUcomattend' Created Successfully", "Error Creating Database: ", false);

        //select database
            selectDB($conn, "TUcomattend");

        //create admin_login table
            $sql = "CREATE TABLE admin_login( 
            username varchar(20), 
            password varchar(16), 
            primary key(username));";

            //create table
            work($conn, $sql, "Table 'admin_login' Created Successfully", "Error Creating Table: ", true);

        //add default admin login
            $sql = "INSERT INTO admin_login
            VALUES ('admin', 'root');";

            //write table
            work($conn, $sql, "Data Written to Table 'admin_login' Successfully", "Error Writing Data to Table: ", true);

        //create student_login table
            $sql = "CREATE TABLE student_login( 
            username varchar(5), 
            password varchar(16), 
            primary key(username));";

            //create table
            work($conn, $sql, "Table 'student_login' Created Successfully", "Error Creating Table: ", true);

        //sql disconnect
            mysqli_close($conn);
        ?>
        <form method = post action = "index.php">
            <input type = "submit" value = "กลับไปหน้าหลัก">
        </form>
</body>