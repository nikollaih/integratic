<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notificación de Nueva Actividad</title>
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
    <h2>Nueva Actividad Programada</h2>
    <p>Estimado/a <?= $estudiante ?>,</p>
    <p>Te informamos que se ha creado una nueva actividad para el grado <strong><?= $actividad["grado"]. $actividad["grupo"] ?></strong> en la plataforma Integratic. A continuación, se detallan los datos:</p>
    <ul>
      <li><strong>Nombre de la Actividad:</strong> <?= $actividad["titulo_actividad"] ?></li>
      <li><strong>Docente Responsable:</strong> <?= $actividad["nombres"]." ". $actividad["apellidos"] ?></li>
      <li><strong>Disponible desde:</strong> <?= $actividad["disponible_desde"] ?><strong> hasta:</strong> <?= $actividad["disponible_hasta"] ?></li>
    </ul>
    <p>Te animamos a revisar la plataforma para obtener más detalles y asegurarte de estar preparado/a para la actividad.</p>
    <p>¡Gracias por tu atención!</p>
    <p>Atentamente,</p>
    <p>El equipo de <?= configuracion()["nombre_institucion"] ?></p>
  </div>
</body>
</html>
