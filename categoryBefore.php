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
		$sql = "SELECT * FROM category WHERE id=" . $_GET["id"];
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		$conn->close();
		?>
		<form action="categoryModify.php?id=<?php echo $_GET['id']; ?>" method="post">
			<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
			name:<input type="text" name="name" value="<?php echo $row[1]; ?>"><br>
			<input type="submit">
			<input type="reset">
		</form>
	</div>
</body>

</html>
