<?php
require "common.php";

$categories = [];
$blogs = [];
$blog = NULL;

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
		$categories[] = $row;
		//echo "<a href='view.php?category=" . $row["id"] . "'>" . $row["name"] . "</a><a href='categoryBefore.php?id=" . $row["id"] . "'>修改分类</a>";
	}
} else {
	echo "0 结果";
}

$category = 0;
$start = 0;

if ($_GET["current"]) {
	$current = $_GET["current"];
	$start = ($_GET["current"] - 1) * 10;
}

if ($_GET["category"]) {
	$category = $_GET["category"];
	if ($_GET["id"]) {
		$id = $_GET["id"];
		$sql = 'SELECT * FROM blog WHERE id=' . $id;
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		$blog = $row;
	} else {
		$sql = 'SELECT * FROM blog WHERE category=' . $category . ' LIMIT ' . $start . ', 10';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$blogs[] = $row;
			}
		} else {
			echo "0 结果";
		}
	}
} else {
	$sql = "SELECT * FROM category LIMIT 1;";
	$result = $conn->query($sql);
	$category = $result->fetch_row()[0];
	if ($_GET["id"]) {
		$id = $_GET["id"];
		$sql = 'SELECT * FROM blog WHERE id=' . $id;
		$result = $conn->query($sql);
		$row = $result->fetch_row();
		$blog = $row;
	} else {
		$sql = 'SELECT * FROM blog WHERE category=' . $category . ' LIMIT ' . $start . ', 10';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$blogs[] = $row;
			}
		} else {
			echo "0 结果";
		}
	}
}

if ($_GET["categoryid"]) {
	$sql = "SELECT * FROM category WHERE id=" . $_GET["categoryid"];
	$result = $conn->query($sql);
	$row = $result->fetch_row();
	$category = $row;
	var_dump($category);
}
