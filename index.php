<?php
require __DIR__ . "/backend/conexion_mysqli.php";

/* CONSULTA: obtener todos los trayectos */
$sql = "SELECT * FROM trayectos ORDER BY id DESC";
$resultado = $mysqli->query($sql);

$trayectos = [];

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $trayectos[] = $fila;
    }
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trayectos CFP</title>
    
    <style>
        body {
            margin: 0;
            background: #0a0a47;
            font-family: 'Arial', sans-serif;
            color: white;
        }

        header {
            background: #06103d;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.4);
        }

        header h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
        }

        .admin-btn {
            background: #ffb300;
            padding: 10px 18px;
            color: #000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: 0.3s;
        }

        .admin-btn:hover {
            background: #ffd35c;
        }

        .contenedor {
            max-width: 1100px;
            margin: auto;
            padding: 30px 20px;
        }

        .tarjeta {
            display: flex;
            background: rgba(255,255,255,0.12);
            border-radius: 12px;
            margin-bottom: 25px;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.15);
            transition: transform 0.2s;
        }

        .tarjeta:hover {
            transform: scale(1.02);
        }

        .tarjeta img {
            width: 260px;
            height: 100%;
            object-fit: cover;
        }

        .info {
            padding: 20px;
            flex: 1;
        }

        .titulo-trayecto {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 10px;
        }

        .descripcion {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.5;
        }

        .horario {
            background: #ffb300;
            padding: 8px 14px;
            color: #000;
            display: inline-block;
            font-weight: bold;
            margin-top: 15px;
            border-radius: 6px;
        }

        .no-data {
            text-align: center;
            margin-top: 50px;
            font-size: 22px;
            opacity: 0.8;
        }
    </style>
</head>

<body>

<header>
    <h1>Trayectos disponibles</h1>
    <a href="./backend/admin_panel.php" class="admin-btn">Admin</a>
</header>

<div class="contenedor">

<?php if (empty($trayectos)): ?>
    <p class="no-data">No hay trayectos cargados aún.</p>
<?php else: ?>
    <?php foreach ($trayectos as $t): ?>
        <div class="tarjeta">

            <img src="./img/<?php echo htmlspecialchars($t['imagen']); ?>" alt="Imagen trayecto">

            <div class="info">

                <h2 class="titulo-trayecto">
                    <?php echo htmlspecialchars($t['nombre']); ?>
                </h2>

                <p class="descripcion">
                    <?php echo nl2br(htmlspecialchars($t['descripcion'])); ?>
                </p>

                <span class="horario">
                    <?php echo htmlspecialchars($t['horario']); ?>
                </span>

            </div>

        </div>
    <?php endforeach; ?>
<?php endif; ?>

</div>

</body>
</html>
