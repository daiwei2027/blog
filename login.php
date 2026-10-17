<?php session_start(); ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>首页</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div id="left">
            <a class="login" href="login.php">登陆</a>
            <a class="register" href="register.php">注册</a>
        </div>
        <div id="right">
            <?php
            if (!$_POST["name"] || !$_POST["password"]) { 
                ?>
                <form action="login.php?category=<?php echo $_GET["category"];?>&blog=<?php echo $_GET["blog"];?>" method="post">
                    用户名：<input type="text" name="name"><br>
                    密码：<input type="password" name="password"><br>
                    <input type="submit">
                    <input type="reset">
                </form>
                <?php
            } else {
                echo $_POST["name"];
                ini_set('display_errors', 'On');
                $servername = 'localhost';
                $username = 'root';
                $password = '@Passw0rd';
                $dbname = 'blog';
                // 创建连接
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die('连接失败: ' . $conn->connect_error);
                }

                $sql = 'SELECT * FROM user WHERE name=' . $_POST["name"] . ' AND password=' . $_POST["password"];
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                if ($row) {
                    $_SESSION['name'] = $row[1];
                    $_SESSION['password'] = $row[2];
                    if ($_GET["blog"]) {
                        header("Location: http://192.168.1.6/blog/detail.php?category=" . $_GET["category"] . "&id=" . $_GET["blog"]);
                    } else {
                       header("Location: http://192.168.1.6/blog/newBlog.php?category=" . $_GET["category"]);
                    }
                } else {
                    echo "用户名或密码不正确";
                }
            }
            ?>
        </div>
        <div id="nav">
        </div>
    </body>

</html>
