<?php
require __DIR__ . '/../functions/codeGeberator.php';
require __DIR__ . '/../functions/accountInfo.php';
$vardas = $sasNr = $pavarde = $asmKodas = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sasNr = $_POST['code'];
    $vardas = $_POST['name'];
    $pavarde = $_POST['surname'];
    $asmKodas = $_POST['personId'];
    
    if (getContent()) {
        foreach (getContent()  as $duomenys) {
            if ($duomenys['personId'] == $asmKodas) {
                header('Location: http://localhost/bankas/pages/naujas.php?error=1');
                die;
            }
        }
    }
    if (strlen($vardas) < 4 || strlen($pavarde) < 4) {
        header('Location: http://localhost/bankas/pages/naujas.php?error=2');
        die;
    } else if (strlen($asmKodas) !== 11) {
        header('Location: http://localhost/bankas/pages/naujas.php?error=3');
        die;
    } else {
        creatAcount($sasNr, $vardas, $pavarde, $asmKodas);
        header('Location: http://localhost/bankas/pages/saskaitos.php?alert=2');
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
        <h3>Nauja sąskaita</h3>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['error'] ?? 0) == 1) { ?>
            <h3 style="color: red;"><?php echo 'ERROR:  Toks asmens asmens kodas jau egzistuoja!'; ?></h3><?php
                                                                                                        }
                                                                                                        if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['error'] ?? 0) == 2) { ?>
            <h3 style="color: red;"><?php echo 'ERROR:  Vardas ir pavarde turi buti ilgesni nei 3 simboliai!'; ?></h3><?php
                                                                                                                    }
                                                                                                                    if ($_SERVER['REQUEST_METHOD'] == 'GET' && ($_GET['error'] ?? 0) == 3) { ?>
            <h3 style="color: red;"><?php echo 'ERROR:  Asmens kodas turi buti is 11 simboliu ir jie turi buti skaiciai!'; ?></h3><?php
                                                                                                                    }

                                                                                                        ?>
        <form action="" method="post" class="new">
            Sąskaitos Nr.: <input type="text" name="code" value="<?php echo acountNr(); ?>" required readonly />
            Vardas: <input type="text" name="name" required />
            Pavarde: <input type="text" name="surname" required />
            Asmens id: <input type="number" name="personId" required />
            <button class="btn">CREATE</button>
        </form>
    </main>
    <footer class="footer">
        <p>&copy; Paulius bank project. First attempt</p>
    </footer>
</body>

</html>