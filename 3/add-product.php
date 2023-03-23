<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافه کردن محصول جدید</title>
</head>

<body style="direction: rtl;">
    <h1>اضافه کردن محصول جدید</h1>
    <form method="post">
        <label for="name">نام محصول</label>
        <input type="text" id="name" name="name"><br>
        <label for="price">قیمت محصول</label>
        <input type="text" id="price" name="price"><br>
        <label for="description">توضیحات محصول</label>
        <input type="text" id="description" name="description"><br>
        <input type="submit" value="افزودن محصول">
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=database;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO product (name, price, description , status)
  VALUES ('$name' , '$price' , '$description' , 'active')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "محصول با موفقیت اضافه شد.";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}

?>