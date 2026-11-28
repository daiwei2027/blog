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
        $root = dirname(__DIR__) . "\blog" . DIRECTORY_SEPARATOR;

        define('MODEL_PATH', $root . 'model' . DIRECTORY_SEPARATOR);
        define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
        define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
        require MODEL_PATH . "model.php";
        foreach ($categories as $category) {
            echo "<a href='view.php?category=" . $category["id"] . "'>" . $category["name"] . "</a><a href='categoryBefore.php?categoryid=" . $category["id"] . "'>修改分类</a>";
        }
        ?>
    </div>
    <div id="right">
        <?php
        foreach ($blogs as $blog) {
            echo "<a href='detail.php?category=" . $category . "&id=" . $blog["id"] . "'>" . $blog["title"] . "</a><br>";
        }
        echo "<a href='newBlog.php?category=" . $category . "'>新建博客</a>";
        ?>
    </div>
    <div id="nav">
        <?php
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