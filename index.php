<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CSS Website Layout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Estilos enlazados-->
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
  </head>
  <body>
    <div class="logo">
      Re-read
    </div>
    <div class="header">
      <h1>Re-read</h1>
      <p>En Re-Read podrás encontrar libros de segunda mano en perfecto estado. También vender los tuyos. Porque siempre hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de los dos.</p>
    </div>
    <div class="row">
      <div class="column left">
        <div class="topnav">
          <a href="index.php">Re-Read</a>
          <a href="view/libros.php">Libros</a>
          <a href="view/ebooks.php">eBooks</a>
        </div>
        <h3>Nunca la lectura ha sido tan necesaria</h3>
        <p>En esto tiempos difíciles Re-Read se suma al mensaje de #yomequedoencasa por el bien común de la sociedad.</p>
        <h3>Reduce & Reuse & Read</h3>
        <p>Somos la librería Eco-Friendly – Re-Read nació pensando en verde con el objetivo de compartir una pasión, la lectura y para expresar una preocupación: si queremos construir un futuro sostenible, es necesario que reduzcamos el consumo y que reutilicemos cuantos más objetos materiales mejor.</p>
      </div>
      <div class="column right">
      <?php
      // 1. Conexión con la base de datos
      include './services/connection.php';

      // 2. Selección y muestra de datos de la base de datos 
      $result = mysqli_query($conn, "SELECT Books.Title FROM Books WHERE Top = '1'");
      
      if (!empty ($result) && mysqli_num_rows($result) > 0){
        //datos de la salida de cada fila (fila=row)
        while ($row = mysqli_fetch_array($result)) {
          //Añadismos la imagen de la página con la etiqueta img de HTML
          echo "<p>".$row['Title']."<br>";
          //Añadimos el título a la página con la etiqueta h2 de HTML
          //echo "div class='desc0".row['Title]." </div>";
        }
      }else {
        echo "0 resultados";
      }
      ?>
      </div>
    </div> 
  </body>
</html>
