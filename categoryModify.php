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
		header("Location: http://192.168.1.6/blog/view.php");
		?>
	</div>
</body>

</html>
