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
            <?php
            require "common.php";
            ?>
        </div>
        <div id="right">
            <?php
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

            if (!$_GET["category"]) {
                $sql = "SELECT * FROM category LIMIT 1;";
                $result = $conn->query($sql);
                $category = $result->fetch_row()[0];
            } else {
                $category = $_GET["category"];
            }

            if ($_GET["current"]) {
                $start = ($_GET["current"] - 1) * 10;
            } else {
                $start = 0;
            }

            $sql = 'SELECT * FROM blog WHERE category=' . $category . ' LIMIT ' . $start . ', 10';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // 输出数据
                while ($row = $result->fetch_assoc()) {
                    echo "<a href='detail.php?category=" . $category . "&id=" . $row["id"] . "'>" . $row["title"] . "</a><br>";
                }
            } else {
                echo "0 结果";
            }
            echo "<a href='newBlog.php?category=" . $category . "'>新建博客</a>";
            ?>
        </div>
        <div id="nav">
            <?php
            // 创建连接
            // Check connection
            if ($conn->connect_error) {
                die('连接失败: ' . $conn->connect_error);
            }
            if (!$_GET["category"]) {
                $sql = "SELECT * FROM category LIMIT 1;";
                $result = $conn->query($sql);
                $category = $result->fetch_row()[0];
            } else {
                $category = $_GET["category"];
            }
            $sql = 'SELECT count(*) FROM blog WHERE category=' . $category;
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            if ($row[0] == 0) {
                $pages = 0;
            } else if ($row[0] % 10 == 0) {
                $pages = $row[0] / 10;
            } else {
                $pages = (int) ($row[0] / 10 + 1);
            }
            if ($_GET["current"]) {
                $current = $_GET["current"];
            } else {
                $current = 1;
            }
            if ($current > 1) {
                echo "<a href='view.php?category=" . $category . "&current=" . $current - 1 . "'>&lt;preview</a>";
            }
            for ($i = 1; $i <= $pages; $i++) {
                if ($i == $current) {
                    echo "<a href='javascript:void(0);' style='color:gray;'>" . $i . "</a>";
                } else {
                    echo "<a href='view.php?category=" . $category . "&current=" . $i . "'>" . $i . "</a>";
                }
            }
            if ($current < $pages) {
                echo "<a href='view.php?category=" . $category . "&current=" . $current + 1 . "'>next&gt;</a>";
            }
            ?>
        </div>
    </body>

</html>
