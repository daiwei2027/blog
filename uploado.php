<?php
ini_set('display_errors', 'On');
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
echo $_FILES["image"];
$temp = explode(".", $_FILES["image"]["name"]);
echo $_FILES["image"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["image"]["type"] == "image/gif")
        || ($_FILES["image"]["type"] == "image/jpeg")
        || ($_FILES["image"]["type"] == "image/jpg")
        || ($_FILES["image"]["type"] == "image/pjpeg")
        || ($_FILES["image"]["type"] == "image/x-png")
        || ($_FILES["image"]["type"] == "image/png"))
    && ($_FILES["image"]["size"] < 2 * 1024 * 1024)   // 小于 2 mb
    && in_array($extension, $allowedExts)
) {
    if ($_FILES["image"]["error"] > 0) {
        echo "错误：: " . $_FILES["image"]["error"] . "<br>";
    } else {
        echo "上传文件名: " . $_FILES["image"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["image"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["image"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["image"]["tmp_name"] . "<br>";

        // 判断当前目录下的 image 目录是否存在该文件
        // 如果没有 image 目录，你需要创建它，image 目录权限为 777
        if (file_exists("images/" . $_FILES["image"]["name"])) {
            echo $_FILES["image"]["name"] . " 文件已经存在。 ";
        } else {
            // 如果 image 目录不存在该文件则将文件上传到 image 目录下
            move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $_FILES["image"]["name"]);
            echo "文件存储在: " . "images/" . $_FILES["image"]["name"];
        }
    }
}
