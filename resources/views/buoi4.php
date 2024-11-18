<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buổi học 4</title>
</head>

<body>
    <!-- 
    File view (hiển thị) là file bắt buộc phải đặt trong thư mục resources /views
    - Có thể sử dụng 2 cách : + Trỏ trực tiếp từ route
                              + Gọi qua hàm Controller
    -->
    <h1>Áo mưa màu hồng</h1>
    <p>Hôm nay là ngày <?= date("d-m-Y") ?></p>
    
    <p> <?= $a ?> + <?= $b ?> = <?= $tong ?></p>
</body>

</html> 