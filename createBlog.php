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
		ini_set('display_errors', 'On');
		$conn->query("SET NAMES UTF8");
		date_default_timezone_set("Asia/Shanghai");

		$sql = "INSERT INTO blog (category,title,content,date) VALUES ('" . $_GET["category"] . "','" . $_POST["title"] . "','" . $_POST["content"] . "','" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "')";

		if ($conn->query($sql) === TRUE) {
			echo $id = $conn->insert_id;
			echo "新记录插入成功";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$sql = 'SELECT count(*) FROM blog WHERE category=' . $_GET["category"];
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		$current = 1;
		$pages = 1;
		if ($row[0] == 0) {
			$pages = 0;
		} else if ($row[0] % 10 == 0) {
			$pages = $row[0] / 10;
		} else {
			$pages = (int) ($row[0] / 10 + 1);
		}
		$current = $pages;

		$conn->close();
		header("Location:" . $domain . "blog/view.php?category=" . $_GET["category"]  . "&current=" . $current);
		?>
	</div>
</body>

</html>