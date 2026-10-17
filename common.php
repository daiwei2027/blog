<?php
$servername = 'localhost';
$username = 'root';
$password = '@Passw0rd';
$dbname = 'blog';

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die('连接失败: ' . $conn->connect_error);
}

$sql = 'SELECT * FROM category';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// 输出数据
	while ($row = $result->fetch_assoc()) {
		echo "<a href='view.php?category=" . $row["id"] . "'>" . $row["name"] . "</a>";
	}
} else {
	echo "0 结果";
}
echo "<a href='newCategory.php'>newCategory</a>";
if($_SESSION['name']){
	echo "<p align='center'>" . $_SESSION['name'] . "</p>";
}
