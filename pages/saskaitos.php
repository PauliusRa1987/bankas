<?php
require __DIR__ .'/../functions/accountInfo.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['suma'] != 0) {
    header('Location: http://localhost/bankas/pages/saskaitos.php?error=1');
    die; 
    }else{ 
    deleteAccount($_GET['id']); 
    header('Location: http://localhost/bankas/pages/saskaitos.php?alert=1');
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
        <h3>Sąskaitų sąrašas</h3>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['error'] ?? 0) == 1) {?>
             <h3 style="color: red;"><?php echo 'OBS! Sąskaitoje dar yra pinigu!'; ?></h3><?php
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['alert'] ?? 0) == 1) {?>
            <h3 style="color: green;"><?php echo 'Sąskaita istrinta sekmingai!'; ?></h3><?php
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['alert'] ?? 0) == 2) {?>
            <h3 style="color: green;"><?php echo 'Sąskaita sukurta sekmingai!'; ?></h3><?php
        }
        ?>
        <ul>
            <?php 

            foreach(getContent() ?? 0 as $duomenys) {  ?>
            <li class="action1">
                <span>Sąskaitos Nr.: <span class="value"><?php echo $duomenys['sasNr'] ?></span></span>
                <span>Vardas: <span class="value"><?php echo $duomenys['name'] ?></span></span>
                <span>Pavarde: <span class="value"><?php echo $duomenys['surname'] ?></span></span>
                <span>Asmens id: <span class="value"><?php echo $duomenys['personId'] ?></span></span>
                <span>Turimos lėšos: <span class="value"><?php echo $duomenys['suma'] ?></span></span>
            
                <div class="action2">
                <form action="http://localhost/bankas/pages/saskaitos.php?id=<?php echo $duomenys['client'] ?>&suma=<?php echo $duomenys['suma'] ?>" method="post">
                <button class="btn" type="submit">DELETE</button>
                </form>
                <a class="btn" href="http://localhost/bankas/pages/add.php?id=<?php echo $duomenys['client'] ?>">Pridėti lėšas</a>
                <a class="btn" href="http://localhost/bankas/pages/remove.php?id=<?php echo $duomenys['client'] ?>">Nuskaičiuoti lėšas</a>
                </div>
            </li>
            <?php }  ?>
        </ul>
    </main>
    <footer class="footer">
    <p>&copy; Paulius bank project. First attempt</p>
    </footer>
</body>
</html>