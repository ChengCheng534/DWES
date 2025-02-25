<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <meta charset="UTF-8">
    <title>Subpágina</title>
</head>
<body>

    <h1><?php echo $textos[$idioma]["subpagina"]; ?></h1>
    <p><?php echo $textos[$idioma]["selecciona"]; ?></p>

    <a href="?lang=es">Español</a> | <a href="?lang=en">English</a>

    <br><br>
    <a href="index.php"><?php echo $textos[$idioma]["volver"]; ?></a>

</body>
</html>
