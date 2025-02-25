<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
</head>
<body>
    <h1><?php echo $textos[$idioma]["saludo"]; ?></h1>
    <p><?php echo $textos[$idioma]["selecciona"]; ?></p>

    <a href="?lang=es">Español</a> | <a href="?lang=en">English</a>

    <br><br>
    <a href="subpagina.php"><?php echo $textos[$idioma]["subpagina"]; ?></a>
</body>
</html>
