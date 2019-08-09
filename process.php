<?php
session_start();

$mysqli = new mysqli('us-cdbr-iron-east-02.cleardb.net', 'b79810968b1254', '153888b3', 'db_crud') or die(mysqli_error($mysqli));

$id = '';
$name = '';
$price = '';

$update = false;

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $price = $_POST['price'];

    $mysqli->query("INSERT INTO tb_hot_dog (name, price) VALUES ('$name', '$price')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM tb_hot_dog WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM tb_hot_dog WHERE id=$id") or die($mysqli->error());
    $update = true;
    if(count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $price = $row['price'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $mysqli->query("UPDATE tb_hot_dog SET name='$name', price='$price' WHERE id=$id") or die($mysqli_error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}