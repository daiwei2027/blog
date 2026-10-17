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
		$servername = "localhost";
		$username = "root";
		$password = "@Passw0rd";
		$dbname = "blog";

		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("连接失败: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM blog WHERE id=" . $_GET["id"];
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		$conn->close();
		?>
		<form action="blogModify.php?id=<?php echo $_GET['id']; ?>" method="post">
			<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
			<input type="hidden" name="category" value="<?php echo $row[1]; ?>">
			title:<input type="text" name="title" value="<?php echo $row[2]; ?>"><br>
			content:<textarea name="content" cols="40" rows="10"><?php echo $row[3] ?></textarea><br>
			<input type="submit">
			<input type="reset">
		</form>
	</div>
</body>

</html>
