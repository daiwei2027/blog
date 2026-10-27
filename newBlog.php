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
		<form method="post" action="createBlog.php?category=<?php echo $_GET['category']; ?>">
			title:<input type="text" name="title"><br>
			content:<textarea id="content" name="content" cols="20" rows="10"></textarea><br>
			<input type="submit">
			<input type="reset">
		</form>
		<form action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" id="fileInput" name="image"><br>
		<input id="submit" type="button" value="插入图片">
		<input type="reset">
		</form>
<div id="progress"></div>
<div id="response"></div>
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
					document.getElementById('content').innerHTML = document.getElementById('content').innerHTML + "http://192.168.1.6/blog/images/" + fileName;
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
