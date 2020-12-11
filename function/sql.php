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
            echo "<h1>" . $fail . mysqli_error($conn) . "</h1><br>";
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
        $sql = "DROP DATABASE TUcomattend;";
        
        if (!mysqli_query($conn, $sql))
        {
            echo "Error Deleting Database: " . mysqli_error($conn);
            mysqli_close($conn);
            echo "<form method = 'post' action = 'index.php'><input type = 'submit' value = 'Back to Main Page'></form>";
            die;
        }
        else
        {
            echo "Database Deleted Successfully<br>";
            mysqli_close($conn);
            echo "<form method = 'post' action = 'index.php'><input type = 'submit' value = 'Back to Main Page'></form>";
            die;
        }
    }
?>