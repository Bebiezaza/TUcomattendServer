<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>
    </head>
    <link href="css/theme.css" rel="stylesheet"/>
    <link href="css/paddedtable.css" rel="stylesheet"/>
        
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

        <center><?php
            error_reporting(0);
            include('config.php');
            include('function/sql.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            $user = $_POST["user"];
            if ($_POST["homesubmit"] == "true") {
                $pass = md5($_POST["pass"]);
            }
            else {
                $pass = $_POST["pass"];
            }
            
            if ($user == "")
            {
?>
                <p class="header">ไม่ได้ลงชื่อผู้ใช้งาน</p>
                <form method = post action = index.php>
                    <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                </form>
<?php
                die;
            }

            //select database
            selectDB($conn, "TUcomattend");

            $sql = "SELECT * from admin_login WHERE username = '$user'";
            if($result = mysqli_query($conn, $sql))
            {
                //login password check
                if (mysqli_num_rows($result) > 0)
                {           
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($user != $row["username"])
                        {
?>
                            <p class="header">ไม่มีชื่อผู้ใช้นี้ในระบบ</p>
                            <form method = post action = index.php>
                                <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                            </form>
<?php
                            die;
                        }
                        elseif ($pass != $row["password"])
                        {
?>
                            <p class="header">รหัสผ่านผิด</p>
                            <form method = post action = index.php>
                                <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                            </form>
<?php
                            die;
                        }
                    }
                    mysqli_free_result($result);
                }
                else
                {
?>
                    <p class="header">ไม่มีชื่อผู้ใช้นี้ในระบบ</p>
                    <form method = post action = index.php>
                        <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                    </form>
<?php
                    die;
                }
            }
?>
        <table cellpadding=5>
        <tr>
        <th></th><th>ด้านการเชื่อมโยงข้อมูล</th><th>ด้านการเรียกข้อมูล</th>
        </tr><tr>
        <td><h3>คอมพิวเตอร์</h3></td>
        <td>
            <!-- computer ip-name connection -->
            <form method = "post" action = "handler/addComputerHandler.php" autocomplete = "off">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <input type = "submit" value = "เชื่อมโยงคอมพิวเตอร์กับไอพี">
            </form>
        </td><td>
            <!-- show log for computer -->
            <form method = "post" action = "fetch/computerLogFetcher.php" autocomplete = "off">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <label for = "com_name">เลือกคอมพิวเตอร์:</label><br>
                    <input list="com_name" name="com_name" />
                    <datalist id="com_name">
<?php
                    $db_com_name = mysqli_query($conn, "SELECT com_name FROM computer_select");
                    while($row = mysqli_fetch_array($db_com_name)) 
                    { 
                        echo"<option value=" . $row['com_name'] . ">"; 
                    }
                    mysqli_free_result($result);
?>
                </datalist><br>
                <input type = submit value = "แสดงข้อมูลจากคอมพิวเตอร์ที่เลือก">
            </form>
        </td>
        </tr><tr>
        <td><h3>ห้องเรียน</h3></td>
        <td>
            <!-- student-class connection -->
            <form method = "post" action = "handler/addStudentToClassHandler.php" autocomplete = "off">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <input type = "submit" value = "เชื่อมโยงรหัสนักเรียนกับห้องเรียน">
            </form>
            
            <!-- academic year change -->
            <form method = "post" action = "handler/yearChangeHandler.php" autocomplete = "off">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <input type = "submit" value = "เริ่มปีการศึกษาใหม่">
            </form>
        </td><td>
            <!-- show log for classroom -->
            <form method = "post" action = "fetch/classroomLogFetcher.php" autocomplete = "off">
                <input type = "hidden" id = "user" type = "text" name = "user" value = <?php echo $user; ?>>
                <input type = "hidden" id = "pass" type = "password" name = "pass" value = <?php echo $pass; ?>>
                <label for = "classroom">เลือกห้องเรียน:</label><br>
                    <input list="classroom" name="classroom" />
                    <datalist id="classroom">
<?php
                    $db_classroom = mysqli_query($conn, "SELECT classroom FROM classroom_info");
                    while($row = mysqli_fetch_array($db_classroom))
                    { 
                        echo"<option value=" . $row['classroom'] . ">"; 
                    }
                    mysqli_free_result($result);
?>
                </datalist><br>
                <input type = submit value = "แสดงข้อมูลจากห้องเรียนที่เลือก">
            </form>
        </td>
        </tr>
        </table><br>
<?php
            //sql disconnect
            mysqli_close($conn);
?>
            <form method = post action = index.php>
                <input class = "login" type = submit value = "> ออกจากระบบ <">
            </form>
            </center>
        </body>