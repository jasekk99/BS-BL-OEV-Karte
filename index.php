<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-index.css">
    <title>Document</title>
</head>
<body>
    <div id="form-wrapper">
        <form action="" method="POST">
            <label for="from">From</label>
            <input type="text" name="from" value="<?php echo $_GET['RequestFrom'] ?>">
            
            <br>
            
            <label for="to" id="to-label">To</label>
            <input type="text" name="to" value="<?php echo $_GET['RequestTo'] ?>">

            <br>
            <p>ex. "Basel, Claraplatz"</p>
            <input type="submit" name="submit" value="Find Connection">
            
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
    </div>
</body>
</html>