<?php
require __DIR__ . '/../functions/accountInfo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['remove'] < 0) {
        header('Location: http://localhost/bankas/pages/remove.php?eroor=2');
        die;
    }
    if ($_POST['remove'] > $_GET['suma']) {
        header('Location: http://localhost/bankas/pages/remove.php?eroor=1');
        die;
    } else {
        outMoney($_GET['id'], $_POST['remove']);
        header('Location: http://localhost/bankas/pages/saskaitos.php');
        die;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankas</title>
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <header class="header">
    <img class="img" src="../images/logo.png" alt="bank logo">
        <nav class="links">
            <a href="http://localhost/bankas/pages/first.php">Home</a>
            <a href="http://localhost/bankas/pages/saskaitos.php">Sąskaitų sąrašas</a>
            <a href="http://localhost/bankas/pages/naujas.php">Nauja sąskaita</a>
            <a  href="http://localhost/bankas/index.php">Sign Out</a>
        </nav>
    </header>
    <main class="main saskaitos">
        <h3>Nuskaičiuoti lėšas</h3>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['eroor'] ?? 0) == 1) { ?>
            <h3 style="color: red;"><?php echo 'OBS! Sąskaitoje yra per mazai pinigu!'; ?></h3><?php
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['eroor'] ?? 0) == 2) { ?>
            <h3 style="color: red;"><?php echo 'OBS! Tokie triukai pro mano akis nepraslys!'; ?></h3><?php
        }
         ?>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            foreach (getContent() as $duomenys) {
                if (($duomenys['client'] ?? 0) == ($_GET['id'] ?? 0)) {
                    $duomenys; ?>

                    <form action="http://localhost/bankas/pages/remove.php?suma=<?php echo $duomenys['suma'] ?>&id=<?php echo $duomenys['client'] ?>" method="post" class="new add">
                        <span>Vardas: <span class="value"><?php echo $duomenys['name'] ?></span></span>
                        <span>Pavarde: <span class="value"><?php echo $duomenys['surname'] ?></span></span>
                        <span>Sąskaitos likutis: <span class="value"><?php echo $duomenys['suma'] ?></span></span>
                        <span>Nuskaičiuojama suma: <input type="text" name="remove" require></span>
                        <button type="submit" class="btn">CASH OUT</button>
                    </form>
        <?php
                } else {
                    null;
                }
            }
        } ?>
    </main>
    <footer class="footer">
        <p>&copy; Paulius bank project. First attempt</p>
    </footer>
</body>

</html>