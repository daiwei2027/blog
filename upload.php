<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "images/"; // 上传文件保存的目录
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true); // 如果目录不存在，则创建目录
    }
    $uploadOk = 1; // 上传状态，1表示成功，0表示失败
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $targetFile = $targetDir . $_FILES['files']['name'][$key];
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // 上传文件的扩展名
        // 检查文件是否已存在
        if (file_exists($targetFile)) {
            echo "对不起，文件已存在.";
            $uploadOk = 0;
        }
        // 允许上传的文件格式
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "对不起，仅允许上传 JPG, JPEG, PNG 和 GIF 文件.";
            $uploadOk = 0;
        }
        // 检查上传状态
        if ($uploadOk == 0) {
            echo "对不起，文件上传失败.";
        } else {
            if (move_uploaded_file($tmp_name, $targetFile)) {
                echo "文件上传成功.";
            } else {
                echo "对不起，文件上传失败.";
            }
        }
    }
}
?>
