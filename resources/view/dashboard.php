<?php 
require('../../app/middleware/auth.php');
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
}else

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(!empty($name)): ?>
        <p><?= $name ?></p>
    <?php endif ; ?>
</body>
</html>