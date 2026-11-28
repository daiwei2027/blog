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

		$sql = "UPDATE category SET name='" . $_POST["name"] . "' WHERE id=" . $_GET["id"];

		if ($conn->query($sql) === TRUE) {
			echo $id = $conn->insert_id;
			echo "新记录插入成功";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
		header("Location:" . $domain . "blog/view.php");
		?>
	</div>
</body>

</html>