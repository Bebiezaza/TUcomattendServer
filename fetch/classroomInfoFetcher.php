<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>
    
<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">ระบบตรวจสอบรายชื่อนักเรียนในห้องเรียน</p>
        </header>
        
        <center>
<?php
            include('../config.php');
            include('../function/sqlHelper.php');
            include('../function/formHelper.php');
            
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            $classroom = $_POST["classroom"];

            //custom redirect
            function redirectCustom2($user, $pass, $classroom, $notice, $dir, $buttonClass, $text)
            {
                echo "$notice";
                echo "<form method = 'post' action = '$dir' autocomplete = 'off'>";
                    echo "<input type = 'hidden' id = 'user' type = 'text' name = 'user' value = $user>";
                    echo "<input type = 'hidden' id = 'pass' type = 'password' name = 'pass' value = $pass>";
                    echo "<input type = 'hidden' id = 'classroom' type = 'text' name = 'classroom' value = $classroom>";
                    echo "<input class = '$buttonClass' type = 'submit' value = '$text'>";
                echo "</form>";
            }

            if(isset($_POST['continue']))
            {
                error_reporting(0);
                $student_num = $_POST["student_num"];
                $student_id = $_POST["student_id"];
                
                if($student_num == "")
                {
                    redirectCustom2($user, $pass, $classroom, "ไม่ได้ระบุนักเรียนที่จะนำรหัสมาแทน", "", "login_fail", "← ย้อนกลับ");
                }
                elseif($student_id == "")
                {
                    redirectCustom2($user, $pass, $classroom, "ไม่ได้ระบุรหัสนักเรียนที่จะนำมาแทน", "", "login_fail", "← ย้อนกลับ");
                }
                else
                {
                    $conn = mysqli_connect($db_host, $db_user, $db_pass);

                    selectDB($conn, "$db_name");
                    
                    $column = "student_$student_num";
                //update account password
                    $sql = "UPDATE classroom_info
                    SET $column = $student_id
                    WHERE classroom = $classroom;";

                    //write table
                    work($conn, $sql, "แก้ไขนักเรียนสำเร็จ", "ไม่สามารถแก้ไขนักเรียนคนนี้ได้: ");

                //sql disconnect
                    mysqli_close($conn);

                    redirectCustom2($user, $pass, $classroom, "", "", "login", "> กลับสู่หน้าเดิม <");
                }
            }
            else
            {
                if(!$classroom == "")
                {
?>
                    <form method = 'post' autocomplete = 'off'>
                        <input type = 'hidden' id = 'user' type = 'text' name = 'user' value = <?php echo $user; ?>>
                        <input type = 'hidden' id = 'pass' type = 'password' name = 'pass' value = <?php echo $pass; ?>>
                        <input type = 'hidden' id = 'classroom' type = 'text' name = 'classroom' value = <?php echo $classroom; ?>>
                        <label for = student_num>นักเรียนคนที่:</label><br>
                        <input list = student_num name = student_num />
                            <datalist id = student_num>
<?php
                            for ($i=1; $i<=50; $i++)
                            {
                                echo "<option value = " . $i . ">";
                            }
?>
                        </datalist><br>

                        <label for = student_id>เปลี่ยนรหัสนักเรียนเป็น:</label><br>
                        <input id = 'pass' type = 'text' maxlength="5" name = 'student_id'><br><br>

                        <input class = "login_fail" type = submit name = "continue" value = "> แก้ไขนักเรียนคนนี้ <">
                    </form>
                    <hr>
<?php
                    $conn = mysqli_connect($db_host, $db_user, $db_pass);

                    selectDB($conn, "$db_name");

                    echo "<h3>ห้องเรียน: $classroom</h3>";
                    $db_classroom = mysqli_query($conn, "SELECT * FROM classroom_info where classroom = '$classroom'");
                    echo"<font face = 'monospaced'><table cellpadding = 5>";
                    while($row = mysqli_fetch_array($db_classroom)) 
                    {
                        for ($i=1; $i<=50; $i++)
                        {
                            if (strlen($i) == 1) { $j = "0" . $i; }
                            else { $j = $i; }
                            echo "<tr>";
                            echo "<th>นักเรียนคนที่ $j:</th>";
                            echo "<td class='classList'>" . $row["student_$i"] . "</td>";
                            echo "</tr>";
                        }
                    }
                    mysqli_free_result($db_classroom);

                    echo"</tr></table></font>";

                    //sql disconnect
                    mysqli_close($conn);
                }
                else
                {
                    echo "<h3>ไม่ได้มีการเลือกห้องเรียน</h3>";
                }
                echo "<hr>";
                redirectCustom($user, $pass, "", "../landing.php", "login", "> กลับสู่หน้าเดิม <");
            }
?>
        </center>
    </body>
</html>