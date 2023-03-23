<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حذف محصولات</title>
</head>

<body style="direction: rtl;">

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=database;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_GET['pid'])) {

            $id = $_GET['pid'];
            // sql to delete a record
            $sql = "DELETE FROM product WHERE id=$id";

            // use exec() because no results are returned
            $conn->exec($sql);
            echo "محصول حذف گردید";
        }
        $stmt = $conn->prepare("SELECT id,name, price, description FROM product WHERE status='active'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
    ?>

    <h1>حذف محصولات</h1>
    <?php
    foreach ($stmt->fetchAll() as $product):
        $pid = $product['id'];
        $name = $product['name'];
        $price = $product['price'];
        $description = $product['description'];
        ?>
        <div>
            <p>
                <?php echo $name ?>
            </p>
            <p>
                <?php echo $price ?>
            </p>
            <p>
                <?php echo $description ?>
            </p>
            <a href="?pid=<?php echo $pid ?>">حذف محصول</a>
        </div><br>
    <?php endforeach; ?>
</body>

</html>