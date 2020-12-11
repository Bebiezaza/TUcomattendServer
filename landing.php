<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>Login Passthrough Test</title>
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

        <?php
            include('globalvar.inc');

            $conn = mysqli_connect($sql_server, $sql_username, $sql_password);

            $user = $_POST["login_name"];
            $pass = $_POST["login_pass"];

echo "DB SERVER: " . $sql_server;
echo "<br>DB USERNAME: " . $sql_username;
echo "<br>DB PASSWORD: ". $sql_password;
echo "<br>USERNAME: " . $user;
echo "<br>PASSWORD: ". $pass . "<br>";

            if ($user == "")
            {
                echo "<font size = 6><b>NO ROOM SPECIFIED!!</b></font>"
                ?><form method = post action = index.php>
                    <input type = submit value = "Back to Login">
                </form><?php
                die;
            }

            //select database
            if (!mysqli_select_db($conn, "TUcomattend"))
            {
                echo "<br>Error Using Database: " . mysqli_error($conn);
            }

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
                            echo "<font size = 6><b>ROOM NOT REGISTERED!!</b></font>";
                            ?><form method = post action = index.php>
                                <input type = submit value = "Back to Login">
                            </form><?php
                            die;
                        }
                        elseif ($pass != $row["password"])
                        {
                            echo "<font size = 6><b>WRONG PASSWORD!!</b></font>";
                            ?><form method = post action = index.php>
                                <input type = submit value = "Back to Login">
                            </form><?php
                            die;
                        }
                    }
                    mysqli_free_result($result);
                }
                else
                {
                    echo "<font size = 6><b>ROOM NOT REGISTERED!!</b></font>";
                    ?><form method = post action = index.php>
                        <input type = submit value = "Back to Login">
                    </form><?php
                    die;
                }
            }

            echo "<font size = 8>Welcome, " . $user . ". </font>";
        ?>
        </body>