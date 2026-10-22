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
		$conn->query("SET NAMES UTF8");
		date_default_timezone_set("Asia/Shanghai");

		$sql = "INSERT INTO blog (category,title,content,date) VALUES ('" . $_GET["category"] . "','" . $_POST["title"] . "','" . $_POST["content"] . "','" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "')";

		if ($conn->query($sql) === TRUE) {
			echo $id = $conn->insert_id;
			echo "新记录插入成功";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
	$sql = 'SELECT count(*) FROM blog WHERE category=' . $category;
            $result = $conn->query($sql);
            $row = $result->fetch_row();
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
		header("Location: http://192.168.1.6/blog/view.php?category=" . $category . "&current=" . $current);
		?>
	</div>
</body>

</html>
