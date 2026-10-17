<?php
		ini_set('display_errors', 'On');
		$servername = "localhost";
		$username = "root";
		$password = "@Passw0rd";
		$dbname = "blog";
		
		

		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);
		// 检测连接
		if ($conn->connect_error) {
			die("连接失败: " . $conn->connect_error);
		}

		$conn->query("SET NAMES UTF8");
		date_default_timezone_set("Asia/Shanghai");
		
            if (!$_GET["category"]) {
                $sql = "SELECT * FROM category LIMIT 1;";
                $result = $conn->query($sql);
                $category = $result->fetch_row()[0];
            } else {
                $category = $_GET["category"];
            }

		$sql = "INSERT INTO comment (blog,content,date)  VALUES ('" . $_GET["blog"] . "','" . $_POST["content"] . "','" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "')";

		if ($conn->query($sql) === TRUE) {
			echo $id = $conn->insert_id;
			echo "新记录插入成功";
			header("Location: http://192.168.1.6/blog/detail.php?category=" . $category . "&id=" . $_GET["blog"]);
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
		?>
