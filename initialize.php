<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>INITIALIZE</title>
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
    $conn = mysqli_connect($sql_server, $sql_username, $sql_password);

//check connection
    if (!$conn)
    {
        die("<h1>Connection Failed: " . mysqli_connect_error()) . "</h1><br>";
    }
    
//create database
    $sql = "CREATE DATABASE TUcomattend COLLATE utf8_general_ci;";
    if (!mysqli_query($conn, $sql))
    {
        die("Error Creating Database: " . mysqli_error($conn)) . "</h1><br>";
    }
    else
    {
        echo "Database 'TUcomattend' Created Successfully<br>";
    }


//create table
    $sql = "CREATE TABLE admin_login( 
    username varchar(20), 
    password varchar(16), 
    primary key(username));";
    
    //select database
    if (!mysqli_select_db($conn, "TUCOMATTEND"))
    {
        echo "<h1>Error Using Database: " . mysqli_error($conn) . "</h1><br>";
        death($conn);
    }
    else
    {
        echo "Database 'TUcomattend' Select Successfully<br>";
    }

    //create table
    if (!mysqli_query($conn, $sql))
    {
        echo "<h1>Error Creating Table: " . mysqli_error($conn) . "</h1><br>";
        death($conn);
    }
    else
    {
        echo "Table 'admin_login' Created Successfully<br>";
    }

//add default admin login
    $sql = "INSERT INTO admin_login
    VALUES ('admin', 'root');";

    //select database
    if (!mysqli_select_db($conn, "TUCOMATTEND"))
    {
        echo "<h1>Error Using Database: " . mysqli_error($conn) . "</h1><br>";
        death($conn);
    }
    else
    {
        echo "Database 'TUcomattend' Select Successfully<br>";
    }

    //write table
    if (!mysqli_query($conn, $sql))
    {
        echo "<h1>Error Writing Data to Table: " . mysqli_error($conn) . "</h1><br>";
        death($conn);
    }
    else
    {
        echo "Data Written to Table 'admin_login' Successfully<br>";
    }

    //drop database (error function)
    function death($conn)
    {
        $sql = "DROP DATABASE TUcomattend;";
        
        if (!mysqli_query($conn, $sql))
        {
        die("Error Deleting Database: " . mysqli_error($conn));
        }
        else
        {
        die("Database Deleted Successfully<br>");
        }
    }

    echo "<h1>Operation Finished</h1>";
    mysqli_close($conn);
?>

        <form action = "index.php">
            <input type = "submit" value = "Back to Main Page">
        </form>
</body>