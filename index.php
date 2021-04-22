<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="from">From</label>
        <input type="text" name="from">

        <label for="to">To</label>
        <input type="text" name="to">

        <input type="submit" name="submit">
        
        <?php 
            if (isset($_POST['submit'])){
                if(!empty(['from']) && !empty(['to'])){
                    header('Location: map.php?RequestFrom='.$_POST['from'].'&RequestTo='.$_POST['to'].'');
            }               
            else{
                echo("missing parameter!");
                }
            }
        ?>

    </form>
</body>
</html>