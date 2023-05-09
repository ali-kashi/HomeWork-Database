<?php
//read pid from file all_product
$pid =  $_GET['pid'];

@$prid = $_GET['prid'];
if(isset($prid))
    $message = $_GET['message'];
else
    $prid = 0;

$uid = 2;

?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کامنت</title>
</head>
<body style="direction: rtl;">
    <h1>ایجاد کامنت</h1>
    <form action="" method="post">
        <textarea name="" cols="50" rows="5" disabled><?php if(isset($message))echo $message; else echo 'Null'; ?></textarea>
</br>
        <textarea name="message" cols="50" rows="10"></textarea>
        </br>
        <input type="submit" value='ارسال'>
    </form>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];;
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=database;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO comments (uid, prid, pid , message,state)
  VALUES ($uid , $prid , $pid ,'$message', 'active')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "کامنت با موفقیت اضافه شد.";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;
}
?>

    </br></br>
    <h2>لیست کامنت ها</h2>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=database;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id,message FROM comments WHERE pid=$pid and state='active' and prid=0");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;

    foreach ($stmt->fetchAll() as $comment):
        $id = $comment['id'];
        $message = $comment['message'];
        ?>
        <div>
            <p>
                <?php echo $message ?>
            </p>
            <a href='?prid=<?php echo $id ?>&pid=<?php echo $pid ?>&message=<?php echo $message ?>'>پاسخ</a>
        </div>
        <?php
            try {
                $conn = new PDO("mysql:host=$servername;dbname=database;charset=utf8", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT id,message FROM comments WHERE state='active' and prid=$id");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        
            $conn = null;
        ?>
        <?php
            foreach ($stmt->fetchAll() as $comment):
                $id = $comment['id'];
                $message = $comment['message'];
                ?>
                <div style='margin-right : 20px'>
                    <p>
                        <?php echo $message ?>
                    </p>
                </div>
            <?php endforeach; ?>
    <?php endforeach; ?>
</body>
</html>