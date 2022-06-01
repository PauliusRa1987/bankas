<?php
require __DIR__.'/pages/manualReg.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['username'] != $viskas['username']) {
        header('Location: http://localhost/bankas/index.php?error=1');
        die; 
    }
    if ($_POST['password'] != $viskas['password']) {
        header('Location: http://localhost/bankas/index.php?error=2');
        die; 
    }
    header('Location: http://localhost/bankas/pages/first.php');
        die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankas</title>
    <link rel="stylesheet" href="./main.css">
</head>
<body>
    <header class="header">
        <img class="img" src="./images/logo.png" alt="bank logo">
    </header>
    <main class="main">
        <h1></h1>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['error'] ?? 0) == 1) { ?>
            <h3 style="color: red;"><?php echo 'Tokio vartotojo nera!'; ?></h3><?php
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['error'] ?? 0) == 2) { ?>
            <h3 style="color: red;"><?php echo 'Neteisingas slaptazodis!'; ?></h3><?php
        }
         ?>
        <h2 style="margin-left: 200px; " >Please LOGIN:</h2>
        <form style="background-color: #7F99A1; padding: 10px" action="" method="post" class="new" name="singin">
            Username: <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
            Password: <input type="password" name="password" required />
            <button type="submit" value="login" name="login" class="btn">Login</button>
        </form>
    </main>
    <footer class="footer">
    <p>&copy; Paulius bank project. First attempt</p>
    </footer>
</body>
</html>