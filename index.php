<?php require_once 'process.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>CRUD Hot Dog App</title>
</head>
<body>
    <?php echo "HEllo";?>
    <?php
        if(isset($_SESSION['message'])):
    ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
    
            <?php
                 echo $_SESSION['message'];
                 unset($_SESSION['message']);
            ?>
    </div>
    <?php endif ?>
    <div class="container">
    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'db_crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM tb_hot_dog") or die($mysqli->error);
    //pre_r($result);
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
        <?php
            while($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a class="btn btn-info" 
                    href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    <a class="btn btn-danger"
                    href="process.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile ?>
        </table>
    </div>
    <?php
        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>
        <div class="row justify-content-center">
            <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id;?>">    
            <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter the name" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" placeholder="Enter the price" value="<?php echo $price;?>">
                </div>
                <div class="form-group">
                <?php    
                if($update == true):
                ?>
                    <button type="submit" name="update" class="btn btn-info">Update</button>
                <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                <?php endif ?>
                </div>
            </form>
            </div>
    </div>
</body>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
