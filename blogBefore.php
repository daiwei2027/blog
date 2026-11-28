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
		<form action="blogModify.php?id=<?php echo $_GET['id']; ?>" method="post">
			<input type="hidden" name="id" value="<?php echo $blog[0]; ?>">
			<input type="hidden" name="category" value="<?php echo $blog[1]; ?>">
			title:<input type="text" name="title" value="<?php echo $blog[2]; ?>"><br>
			content:<textarea name="content" cols="40" rows="10"><?php echo $blog[3] ?></textarea><br>
			<input type="submit">
			<input type="reset">
		</form>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" id="fileInput" name="image"><br>
			<input id="submit" type="button" value="插入图片">
			<input type="reset">
		</form>
	</div>
	<script>
		document.getElementById('submit').addEventListener('click', function(e) {
			var input = document.getElementById('fileInput');
			var files = input.files;
			var formData = new FormData();
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				formData.append('files[]', file);
			}
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				console.log(xhr.readyState + "1" + xhr.status + "2");
				if (xhr.readyState === 4 && xhr.status === 200) {
					document.getElementById('response').innerHTML = xhr.responseText;
					const fileName = files[0].name;
					console.log(fileName);
					// 可选：显示在页面上
					document.getElementById('content').value = document.getElementById('content').value + "http://192.168.1.6/blog/images/" + fileName;
				}
			};
			xhr.upload.onprogress = function(event) {
				if (event.lengthComputable) {
					var progress = (event.loaded / event.total) * 100;
					document.getElementById('progress').innerHTML = '上传进度：' + progress + '%';
				}
			};
			xhr.open('POST', 'upload.php', true);
			xhr.send(formData);

		});
	</script>
</body>

</html>