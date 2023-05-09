<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>لیست کامنت های شما</h2>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $uid = 2;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=database;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT message,product.name FROM comments inner join product on comments.pid = product.id WHERE state='active' and uid=$uid");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;

    foreach ($stmt->fetchAll() as $comment):
        $pname = $comment['name'];
        $message = $comment['message'];
        ?>
        <div> 
            <p>
                <?php 
                    echo $pname ;
                    echo '</br>';
                    echo $message ;
                ?>
            </p>
        </div>
    <?php endforeach; ?>
</body>
</html>