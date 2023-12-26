<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notificación de Nuevo Foro</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #333;
    }
    p {
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Nuevo Foro Programado</h2>
    <p>Estimado/a <?= $estudiante ?>,</p>
    <p>Te informamos que se ha creado un nuevo foro para el grado <strong><?= $foro["grado"]. $foro["grupo"] ?></strong> en la plataforma Integratic. A continuación, se detallan los datos:</p>
    <ul>
        <li><strong>Materia:</strong> <?= $foro["nommateria"] ?></li>
        <li><strong>Nombre del foro:</strong> <?= $foro["titulo_foro"] ?></li>
        <li><strong>Docente Responsable:</strong> <?= $foro["nombres"]." ". $foro["apellidos"] ?></li>
        <li><strong>Disponible desde:</strong> <?= $foro["disponible_desde"] ?><strong> hasta:</strong> <?= $foro["disponible_hasta"] ?></li>
    </ul>
    <p>Te animamos a revisar la plataforma para obtener más detalles.</p>
    <p>¡Gracias por tu atención!</p>
    <p>Atentamente,</p>
    <p>El equipo de <?= configuracion()["nombre_institucion"] ?></p>
  </div>
</body>
</html>
