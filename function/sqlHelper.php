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
    function work($conn, $sql, $success, $fail)
    {
        if (!mysqli_query($conn, $sql))
        {
            echo "<h3>" . $fail . mysqli_error($conn) . "</h3><br>";
        }
        else
        {
            echo $success . "<br>";
        }
    }
?>