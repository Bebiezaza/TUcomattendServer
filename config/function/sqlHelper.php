<?php
//select database function
    function selectDB($conn, $dbname)
    {
        if (!mysqli_select_db($conn, $dbname))
        {
            echo "<h1>Error Using Database: " . mysqli_error($conn) . "</h1><br>";
            
            //sql disconnect
            mysqli_close($conn);
?>
        <form method = "post" action = index.php>
            <input type = submit value = "← ย้อนกลับ">
        </form>
<?php
            die;
        }
    }

//work function
    function work($conn, $sql, $success, $fail, $error, $formbehave)
    {
        if (!mysqli_query($conn, $sql))
        {
            echo "<h1>" . $fail . mysqli_error($conn) . "</h1><br>";

            if($error == true) error($conn, $formbehave);
        }
        else
        {
            echo $success . "<br>";
        }
    }

//reset database (error function)
    function error($conn, $formbehave)
    {
        include('../config.php');
        
        if ($_POST["db_name"]) $db_name = $_POST["db_name"];
        
        $sql = "DROP DATABASE $db_name;";
        
        if (!mysqli_query($conn, $sql))
        {
            echo "Error Resetting System at stage 1: " . mysqli_error($conn);
            mysqli_close($conn);
            echo "<form method = 'post' name = $formbehave action = 'index.php'><input type = 'submit' value = '← ย้อนกลับ'></form>";
            die;
        }
        else
        {
            echo "System Reset Stage 1 Successful<br>";
        }

        $sql2 = "CREATE DATABASE $db_name COLLATE utf8_general_ci;";

        if (!mysqli_query($conn, $sql2))
        {
            echo "Error Resetting System at stage 2: " . mysqli_error($conn);
            mysqli_close($conn);
            echo "<form method = 'post' name = $formbehave action = 'index.php'><input type = 'submit' value = '← ย้อนกลับ'></form>";
            die;
        }
        else
        {
            echo "System Reset Stage 2 Successful<br>";
            echo "System Reset Successfully<br>";
            mysqli_close($conn);
            echo "<form method = 'post' name = $formbehave action = 'index.php'><input type = 'submit' value = '← ย้อนกลับ'></form>";
            die;
        }
    }
?>