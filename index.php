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
        /* ==== ESTILO GENERAL ==== */
        body {
            margin: 0; /* Saca márgenes del navegador */
            background: #0a0a47; /* Fondo azul oscuro */
            color: white; /* Texto blanco */
            font-family: Arial, sans-serif; /* Fuente simple */
        }

        /* ==== HEADER ==== */
        header {
            background: #06103d; /* Banda más oscura arriba */
            padding: 20px; /* Espaciado interno */
            display: flex; /* Ubica elementos en fila */
            justify-content: space-between; /* Los separa a los extremos */
            align-items: center; /* Centra vertical */
        }

        header h1 {
            margin: 0; /* Saca el margen default */
            font-size: 26px; /* Tamaño del título */
        }

        /* ==== BOTONES DEL HEADER ==== */
        .admin-btn {
            background: #ffb300; /* Amarillo */
            padding: 10px 16px; /* Tamaño del botón */
            color: black; /* Texto negro para buen contraste */
            text-decoration: none; /* Quita subrayado */
            border-radius: 6px; /* Bordes redondeados */
            font-weight: bold; /* Texto fuerte */
        }

        /* ==== CONTENEDOR PRINCIPAL ==== */
        .contenedor {
            max-width: 1000px; /* Ancho máximo */
            margin: auto; /* Centra horizontal */
            padding: 20px; /* Espaciado interno */
        }

        /* ==== TARJETA DE TRAYECTO ==== */
        .tarjeta {
            display: flex; /* Imagen + texto en fila */
            background: rgba(255,255,255,0.1); /* Fondo semi transparente */
            margin-bottom: 20px; /* Espacio entre tarjetas */
            border-radius: 10px; /* Bordes redondeados */
            overflow: hidden; /* Para que la imagen no sobresalga */
        }

        /* ==== IMAGEN DE CADA CURSO ==== */
        .tarjeta img {
            width: 240px; /* Tamaño fijo */
            height: 100%; /* Mantener proporcion */
            object-fit: cover; /* Recorta bien la imagen */
        }

        /* ==== INFORMACIÓN DEL CURSO ==== */
        .info {
            padding: 20px; /* Espaciado interior */
            flex: 1; /* Ocupa todo el espacio restante */
        }

        .titulo-trayecto {
            margin: 0 0 10px; /* Abajo un espacio */
            font-size: 22px; /* Tamaño del título */
        }

        .descripcion {
            font-size: 15px; /* Tamaño del texto */
            line-height: 1.4; /* Mejor lectura */
        }

        /* ==== HORARIO ==== */
        .horario {
            margin-top: 12px; /* Espacio arriba */
            background: #ffb300; /* Fondo amarillo */
            padding: 6px 12px; /* Tamaño del recuadro */
            border-radius: 6px; /* Bordes redondeados */
            color: black; /* Texto oscuro */
            font-weight: bold; /* Resalta */
            display: inline-block; /* Se comporta como botón */
        }

        /* ==== MENSAJE SIN DATOS ==== */
        .no-data {
            text-align: center; /* Centrado */
            margin-top: 40px; /* Espacio */
            font-size: 20px; /* Texto más grande */
        }

        /* ==== RESPONSIVE MODO CELULAR ==== */
        @media (max-width: 700px) {

            .tarjeta {
                flex-direction: column; /* Imagen arriba, texto abajo */
            }

            .tarjeta img {
                width: 100%; /* Imagen ocupa todo el ancho */
                height: 200px; /* Alto fijo */
            }

            header {
                flex-direction: column; /* Poner título arriba y botones abajo */
                gap: 10px; /* Espacio entre elementos */
                text-align: center;
            }
        }

    </style>
</head>

<body>

<header>
    <h1>Trayectos disponibles</h1>

    <!-- Botones superiores -->
    <a href="./backend/admin_panel.php" class="admin-btn">Admin</a>
    <a href="./index_old.html" class="admin-btn">Volver</a>
</header>

<div class="contenedor">

<?php if (empty($trayectos)): ?>
    <p class="no-data">No hay trayectos cargados aún.</p>
<?php else: ?>
    <?php foreach ($trayectos as $t): ?>
        <div class="tarjeta">

            <!-- Imagen del trayecto -->
            <img src="./img/<?php echo htmlspecialchars($t['imagen']); ?>" alt="Imagen trayecto">

            <!-- Texto del trayecto -->
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
