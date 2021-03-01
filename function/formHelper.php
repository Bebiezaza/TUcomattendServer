<?php
//landing failed notice
    function landingFailed($conn, $text)
    {
        echo "<p class='header'>$text</p>";
?>
        <form method = "post" action = index.php>
            <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
        </form>
<?php
        //sql disconnect
        mysqli_close($conn);
        
        die;
    }

//redirect
    function redirect($user, $pass, $dir, $text)
    {
        echo "<form method = 'post' action = $dir autocomplete = 'off'>";
            echo "<input type = 'hidden' id = 'user' type = 'text' name = 'user' value = $user>";
            echo "<input type = 'hidden' id = 'pass' type = 'password' name = 'pass' value = $pass>";
            echo "<input type = 'submit' value = $text>";
        echo "</form>";

    }


//custom redirect
    function redirectCustom($user, $pass, $notice, $dir, $buttonClass, $text)
    {
        echo "$notice";
        echo "<form method = 'post' action = '$dir' autocomplete = 'off'>";
            echo "<input type = 'hidden' id = 'user' type = 'text' name = 'user' value = $user>";
            echo "<input type = 'hidden' id = 'pass' type = 'password' name = 'pass' value = $pass>";
            echo "<input class = '$buttonClass' type = 'submit' value = '$text'>";
        echo "</form>";
    }    

//droplist redirect
function redirectDroplist($conn, $user, $pass, $dir, $varname, $text1, $row, $table, $text2)
{
    echo "<form method = 'post' action = $dir autocomplete = 'off'>";
        echo "<input type = 'hidden' id = 'user' type = 'text' name = 'user' value = $user>";
        echo "<input type = 'hidden' id = 'pass' type = 'password' name = 'pass' value = $pass>";
        echo "<label for = $varname>$text1:</label><br>";
        echo "<input list = $varname name = $varname />";
            echo "<datalist id = $varname>";
            $sql = mysqli_query($conn, "SELECT $row FROM $table");
            while($result = mysqli_fetch_array($sql)) 
            { 
                echo"<option value = " . $result[$row] . ">"; 
            }
            mysqli_free_result($sql);
            echo "</datalist><br>";
        echo "<input type = submit value = $text2>";
    echo "</form>";
}
?>