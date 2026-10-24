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
		if (!$_POST["name"] && !$_POST["password"]) {
		?>
			<form action="register.php" method="post">
				用户名：<input type="text" name="name"><br>
				密码：<input type="password" name="password"><br>
				<input type="submit">
				<input type="reset">
			</form>
			<?php
		} else {
			echo $_POST["name"];
			ini_set('display_errors', 'On');

			$sql = 'SELECT * FROM user WHERE name=' . $_POST["name"];
			$result = $conn->query($sql);
			$row = $result->fetch_row();
			if ($row) {
				echo "用户名已存在";
				$conn->close();
			?>
				<form action="register.php" method="post">
					用户名：<input type="text" name="name"><br>
					密码：<input type="password" name="password"><br>
					<input type="submit">
					<input type="reset">
				</form>
		<?php
			} else {
				ini_set('display_errors', 'On');

				$sql = "INSERT INTO user (name,password) VALUES ('" . $_POST["name"] . "','" . $_POST["password"] . "')";

				if ($conn->query($sql) === TRUE) {
					echo $id = $conn->insert_id;
					echo "新记录插入成功";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			}
		}
		?>
	</div>
	<div id="nav">
	</div>
</body>

</html>