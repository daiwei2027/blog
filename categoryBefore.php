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
		<form action="categoryModify.php?id=<?php echo $_GET['categoryid']; ?>" method="post">
			<input type="hidden" name="id" value="<?php echo $category[0]; ?>">
			name:<input type="text" name="name" value="<?php echo $category["name"]; ?>">
			<input type="submit">
			<input type="reset">
		</form>
	</div>
</body>

</html>