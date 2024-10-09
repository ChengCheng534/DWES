<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de Figuras SVG</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        svg {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Ejemplo de Figuras SVG</h1>
    
    <svg width="500" height="500">
        <!-- Rectángulo -->
        <rect x="10" y="10" width="150" height="100" fill="lightblue" stroke="black" stroke-width="2" />
        <text x="20" y="50" font-size="16" fill="black">Rectángulo</text>

        <!-- Círculo -->
        <circle cx="250" cy="60" r="50" fill="yellow" stroke="black" stroke-width="2" />
        <text x="210" y="60" font-size="16" fill="black">Círculo</text>

        <!-- Elipse -->
        <ellipse cx="400" cy="60" rx="80" ry="40" fill="pink" stroke="black" stroke-width="2" />
        <text x="360" y="60" font-size="16" fill="black">Elipse</text>

        <!-- Línea -->
        <line x1="50" y1="150" x2="450" y2="150" stroke="red" stroke-width="4" />
        <text x="200" y="140" font-size="16" fill="black">Línea</text>

        <!-- Polígono -->
        <polygon points="150,200 100,350 200,350" fill="lightgreen" stroke="black" stroke-width="2" />
        <text x="110" y="250" font-size="16" fill="black">Polígono</text>

        <!-- Texto -->
        <text x="50" y="450" font-size="24" fill="purple">Esto es un texto en SVG</text>

        <!-- Imagen -->
        <image href="https://www.example.com/tu-imagen.png" x="300" y="200" width="150" height="150" />
        <text x="320" y="380" font-size="16" fill="black">Imagen</text>
    </svg>

</body>
</html>
