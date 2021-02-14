<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="css/theme.css" rel="stylesheet"/>
<link href="css/table.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบตรวจสอบการเข้าใช้คอมพิวเตอร์</p>
        </header>

        <center>
<?php
            $user = $_POST["user"];
            if (isset($_POST['homesubmit']))
            {
                $pass = md5($_POST["pass"]);
            }
            else
            {
                $pass = $_POST["pass"];
            }
            
            if ($user == "")
            {
                landingFailed($conn, "ไม่ได้ลงชื่อผู้ใช้งาน");
            }

            error_reporting(0);
            include('config.php');
            include('function/sql.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            //select database
            selectDB($conn, "$db_name");

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
                            mysqli_free_result($result);
                            landingFailed($conn, "ไม่มีชื่อผู้ใช้นี้ในระบบ");
                        }
                        elseif ($pass != $row["password"])
                        {
                            mysqli_free_result($result);
                            landingFailed($conn, "รหัสผ่านไม่ถูกต้อง");
                        }
                    }
                    mysqli_free_result($result);
                }
                else
                {
                    landingFailed($conn, "ไม่มีชื่อผู้ใช้นี้ในระบบ");
                }
            }
?>
            <table cellpadding=5>
                <tr>
                    <th></th>
                    <th>ด้านการเชื่อมโยงข้อมูล</th>
                    <th>ด้านการเรียกข้อมูล</th>
                </tr><tr>
                    <td><h3>คอมพิวเตอร์</h3></td>
                    <td>
<!-- computer ip-name connection -->
<?php
                        redirect($user, $pass, "handler/addComputerHandler.php", "เชื่อมโยงคอมพิวเตอร์กับไอพี");
?>
                    </td><td>
<!-- show log for computer -->
<?php
                        redirectDroplist($conn, $user, $pass, "fetch/computerLogFetcher.php", "com_name", "เลือกคอมพิวเตอร์", "com_name", "computer_select", "แสดงข้อมูลจากคอมพิวเตอร์ที่เลือก");
?>
                    </td>
                </tr><tr>
                    <td><h3>ห้องเรียน</h3></td>
                    <td>
<!-- student-class connection -->
<?php
                        redirect($user, $pass, "handler/addStudentToClassHandler.php", "เชื่อมโยงรหัสนักเรียนกับห้องเรียน");
//   academic year change
                        redirect($user, $pass, "handler/yearChangeHandler.php", "เริ่มปีการศึกษาใหม่");
?>                  
                    </td>
                    <td>
<!-- show log for classroom -->
<?php
                        redirectDroplist($conn, $user, $pass, "fetch/classroomLogFetcher.php", "classroom", "เลือกห้องเรียน", "classroom", "classroom_info", "แสดงข้อมูลจากห้องเรียนที่เลือก");
?>
                    </td>
                </tr><tr>
                    <td><h3>ข้อมูลส่วนกลาง</h3></td>
                    <td>
<!-- add admins -->
<?php
                        redirect($user, $pass, "handler/addAdminHandler.php", "เพิ่มผู้ดูแลระบบ");
?>
                    </td>
                    <td>
<!-- show all log -->
<?php
                        redirect($user, $pass, "fetch/allLogFetcher.php", "แสดงข้อมูลการใช้คอมพิวเตอร์ทั้งหมด");
?>
                    </td>
                </tr><tr>
                    <td><h3>บัญชีนักเรียน</h3></td>
                    <td>
<!-- change student's password -->
<?php
                        redirect($user, $pass, "handler/changePasswordHandler.php", "แก้ไขรหัสผ่านนักเรียน");
//   delete student's account
                        redirect($user, $pass, "handler/deleteAccountHandler.php", "ลบข้อมูลบัญชีนักเรียน");
                        
                    //sql disconnect
                        mysqli_close($conn);
?>
                    </td>
                    <td></td>
                </tr>
            </table><br>
            
            <form method = post action = index.php>
                <input class = "login" type = submit value = "> ออกจากระบบ <">
            </form>
        </center>
    </body>
</html>