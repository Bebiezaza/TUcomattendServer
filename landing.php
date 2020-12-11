<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>Login Test</title>
    </head>
    <link href="css/theme.css" rel="stylesheet"/>
        
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
            include('globalvar.inc');
            include('function/sql.php');
            $conn = mysqli_connect($sql_server, $sql_username, $sql_password);

            $user = $_POST["login_name"];
            $pass = $_POST["login_pass"];

            if ($user == "")
            {
                echo "<font size = 6><b>ไม่ได้ระบบชื่อผู้ใช้งาน</b></font>"
                ?><form method = post action = index.php>
                    <input type = submit value = "กลับไปเข้าสู่ระบบ">
                </form><?php
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
                            echo "<font size = 6><b>ไม่มีชื่อผู้ใช้นี้ในระบบ</b></font>";
                            ?><form method = post action = index.php>
                                <input type = submit value = "กลับไปเข้าสู่ระบบ">
                            </form><?php
                            die;
                        }
                        elseif ($pass != $row["password"])
                        {
                            echo "<font size = 6><b>รหัสผ่านผิด</b></font>";
                            ?><form method = post action = index.php>
                                <input type = submit value = "กลับไปเข้าสู่ระบบ">
                            </form><?php
                            die;
                        }
                    }
                    mysqli_free_result($result);
                }
                else
                {
                    echo "<font size = 6><b>ไม่มีชื่อผู้ใช้นี้ในระบบ</b></font>";
                    ?><form method = post action = index.php>
                        <input type = submit value = "กลับไปเข้าสู่ระบบ">
                    </form><?php
                    die;
                }
            }

            echo "<font size = 8>Welcome, " . $user . ". </font>";
        ?>

        <form method = post action = index.php>
            <input type = submit value = "ออกจากระบบ">
        </form></center>
        </body>