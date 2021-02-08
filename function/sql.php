<?php
//select database function
    function selectDB($conn, $dbname)
    {
        if (!mysqli_select_db($conn, $dbname))
        {
            echo "<h1>Error Using Database: " . mysqli_error($conn) . "</h1><br>";
            death($conn);
        }
    }

//work function
    function work($conn, $sql, $success, $fail, $death)
    {
        if (!mysqli_query($conn, $sql))
        {
            echo "<h3>" . $fail . mysqli_error($conn) . "</h3><br>";
            if($death == true)
            {
                death($conn);
            }
        }
        else
        {
            echo $success . "<br>";
        }
    }

//drop database (error function)
    function death($conn)
    {
        include('../config.php');
        
        $db_name = $_POST["db_name"];
        
        $sql = "DROP DATABASE $db_name;";
        
        if (!mysqli_query($conn, $sql))
        {
            echo "Error Reseting System: " . mysqli_error($conn);
            mysqli_close($conn);
            echo "<form method = 'post' action = 'index.php'><input type = 'submit' value = 'กลับสู่หน้าหลัก'></form>";
            die;
        }
        else
        {
            echo "System Reset Successfully<br>";
            mysqli_close($conn);
            echo "<form method = 'post' action = 'index.php'><input type = 'submit' value = 'กลับสู่หน้าหลัก'></form>";
            die;
        }
    }
?>