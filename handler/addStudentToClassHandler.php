<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="../css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "../pictures/phrakiao.png">เชื่อมโยงรหัสนักเรียนกับห้องเรียน</p>
        </header>

        <center>
<?php
            include('../config.php');
            include('../function/sql.php');

            $user = $_POST["user"];
            $pass = $_POST["pass"];

            if(isset($_POST["continue"]) && $_POST["classroom"] != "")
            {
                $classroom = $_POST["classroom"];

                //class number loop
                $count = "`classroom`";
                for ($k=1; $k<=50; $k++)
                {
                    $id = $_POST["student_$k"];

                    if ($id != "")
                    {
                        error_reporting(0);
                        if (!$info)
                        {
                            $info = "'$id'";
                        }
                        else
                        {
                            $info = $info . ", '$id'";
                        }

                        $count = $count . ", `student_$k`";
                    }
                }

                $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //select database
                selectDB($conn, "$db_name");

            //add classroom info
                $sql = "INSERT INTO classroom_info ($count)
                VALUES ('$classroom', $info);";

                //write table
                work($conn, $sql, "เพิ่มห้องเรียน $classroom สำเร็จ", "มีปัญหาในระหว่างการเพิ่มห้องเรียน: ");

            //sql disconnect
                mysqli_close($conn);
                
                redirectCustom($user, $pass, "", "../landing.php", "login", "> กลับสู่หน้าเดิม <");
                die;
            }
            else
            {
?>
                <form method = "post" autocomplete = "off">
                    <div class = "login">
                        <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                        <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                        <label for = "classroom">ห้องเรียน: </label>
                        <input id = "classroom" type = "text" maxlength="3" name = "classroom"><br>
                        <font face='monospaced'>
<?php
                        for($i=1; $i<=50; $i++)
                        {
                            if (strlen($i) == 1) { $j = "0" . $i; }
                            else { $j = $i; }

                            echo "<label for = 'student_$i'>นักเรียนเลขที่ $j: </label>";
                            echo "<input id = 'student_$i' type = 'text' maxlength='5' name = 'student_$i'><br>";
                        }
?>
                        </font>
                    </div>
                    
                    <input class = "login" type = "submit" name = "continue" value = "> เพิ่มห้องเรียน <">
                </form>
<?php
            }
?>
        </center>
    </body>
</html>