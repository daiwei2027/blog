<?php session_start(); ?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <!--meta name="viewport" content="width=device-width, initial-scale=1"-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
            if (!$_GET["category"]) {
                $sql = "SELECT * FROM category LIMIT 1;";
                $result = $conn->query($sql);
                $category = $result->fetch_row()[0];
            } else {
                $category = $_GET["category"];
            }

            $sql = 'SELECT * FROM blog WHERE id=' . $id;
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            // 输出数据
            $id = $row[1];
            echo "<p>$row[2]</p><p>$row[3]</p><p>$row[4]</p><a href=blogBefore.php?id=" . $row[0] . ">modify</a><a href=delete.php?id=" . $row[0] . ">delete</a><br>";
            
            $sql = 'SELECT * FROM comment WHERE blog=' . $row[1];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // 输出数据
                while ($row = $result->fetch_assoc()) {
                    echo $row["content"] . "<br>";
                }
            } else {
                echo "0 结果";
            }
            
            if ($_SESSION['name']) {
                ?>
                <form action="comment.php?category=<?php echo $category;?>&blog=<?php echo $id; ?>" method="post">
                    评论:<textarea name="content" cols="40" rows="10"></textarea><br>
                    <input type="submit">
                    <input type="reset">
                </form>
                <?php
            } else {
                echo "<a href='login.php?category=" . $category . "&blog=" . $id . "'>登陆后评论</a>";
            }
            ?>
                    <div id="nav">
            <?php
            $id = $_GET["id"];
            if (!$_GET["category"]) {
                $sql = "SELECT * FROM category LIMIT 1;";
                $result = $conn->query($sql);
                $category = $result->fetch_row()[0];
            } else {
                $category = $_GET["category"];
            }
            $sql = 'SELECT * FROM blog WHERE category=' . $category . ' AND id < ' . $id . ' ORDER BY id DESC LIMIT 1';
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            if ($row) {
                echo "<a href='detail.php?id=" . $row[0] . "'>&lt;previous</a>";
            }
            $sql = 'SELECT * FROM blog WHERE category=' . $category . ' AND id > ' . $id . ' ORDER BY id ASC LIMIT 1';
            $result = $conn->query($sql);
            $row = $result->fetch_row();
            if ($row) {
                echo "<a href='detail.php?id=" . $row[0] . "'>next&gt;</a>";
            }
            $sql = 'SELECT * FROM comment WHERE blog=' . $row[0];
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // 输出数据
                while ($row = $result->fetch_assoc()) {
                    echo "<a href='detail.php?category=" . $category . "&id=" . $row["id"] . "'>" . $row["title"] . "</a><br>";
                }
            } else {
                echo "0 结果";
            }
            $conn->close();
            ?>
        </div>
        </div>

    </body>

</html>
