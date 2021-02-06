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
    function work($conn, $sql, $success, $fail, $death, $formbehave)
    {
        if (!mysqli_query($conn, $sql))
        {
            echo "<h1>" . $fail . mysqli_error($conn) . "</h1><br>";
            if($death == true)
            {
                death($conn, $formbehave);
            }
        }
        else
        {
            echo $success . "<br>";
        }
    }

//drop database (error function)
    function death($conn, $formbehave)
    {
        $sql = "DROP DATABASE TUcomattend;";
        
        if (!mysqli_query($conn, $sql))
        {
            echo "Error Reseting System: " . mysqli_error($conn);
            mysqli_close($conn);
            echo "<form method = 'post' name = $formbehave action = 'index.php'><input type = 'submit' value = '← ย้อนกลับ'></form>";
            die;
        }
        else
        {
            echo "System Reset Successfully<br>";
            mysqli_close($conn);
            echo "<form method = 'post' name = $formbehave action = 'index.php'><input type = 'submit' value = '← ย้อนกลับ'></form>";
            die;
        }
    }
?>