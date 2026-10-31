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
		$sql = "SELECT * FROM blog WHERE id=" . $_GET["id"];
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		$conn->close();
		?>
		<form action="blogModify.php?id=<?php echo $_GET['id']; ?>&current=<?php echo $_GET["current"]; ?>" method="post">
			<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
			<input type="hidden" name="category" value="<?php echo $row[1]; ?>">
			title:<input type="text" name="title" value="<?php echo $row[2]; ?>"><br>
			content:<textarea name="content" cols="40" rows="10"><?php echo $row[3] ?></textarea><br>
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