<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CSS Website Layout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Estilos enlazados-->
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
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
          <a href="../index.php">Re-Read</a>
          <a href="libros.php">Libros</a>
          <a href="ebooks.php">eBooks</a>
        </div>
        <h3>Toda la actualidad en eBooks</h3>
        <!-- Nuevo desarrollo formulario para filtrar autor -->
       <div class="form">
        <form action="ebooks.php" method="REQUEST">
          <label for="fname">Autor</label>
          <input type="text" id="fautor" name="fautor" placeholder="Introduce el autor...">
          <label for="titulo">Título</label>
          <input type="text" id="titulo" name="titulo" placeholder="Introduce un título...">
          
          <!-- <label for="lname">Last Name</label>
          <input type="text" id="lname" name="lastname" placeholder="Your last name..">
          -->
          <label for="country">País</label>
          <select id="country" name="country">
            <option value="%">Todos los paises</option>
            <?php
            include '../services/connection.php';
            $query="SELECT DISTINCT Authors.Country FROM Authors ORDER BY Country";
            $result=mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="'.$row[Country].'">'.$row[Country].'</option>';
            }
            ?>
          </select> 
          <input type="submit" value="Buscar">
        </form>
      </div>
        <?php
        // 1. Conexión con la base de datos
        if (isset($_REQUEST['fautor'])) {
          $query = "SELECT Books.Description, Books.img, Books.Title FROM Books 
          INNER JOIN BooksAuthors ON Books.Id=BooksAuthors.BookId
          INNER JOIN Authors ON Authors.Id = BooksAuthors.AuthorId 
          WHERE Authors.Name LIKE '%{$_REQUEST['fautor']}%'
          AND Authors.Country LIKE '%{$_REQUEST['country']}%'
          AND Books.Title  LIKE '%{$_REQUEST['titulo']}%'";
          $result = mysqli_query($conn, $query);
  
          //Mostrará todos los ebooks de la DB
        }else{
          $result = mysqli_query($conn, "SELECT Books.Description, Books.img, Books.Title FROM Books WHERE eBook != '0'");
        }
        if (!empty ($result) && mysqli_num_rows($result) > 0){
          //datos de la salida de cada fila (fila=row)
          $i=0;
          while ($row = mysqli_fetch_array($result)) {
            $i++;
            echo "<div class='ebook'>";
            //Añadismos la imagen de la página con la etiqueta img de HTML
            echo "<img src=../img/".$row['img']." alt='".$row['Title'].$row['Description']."'>";
            //Añadimos el título a la página con la etiqueta h2 de HTML
            echo "<div class= 'desc0'>".$row['Description']."</div>";
            echo "</div>";
            if ($i%3==0) {
              echo "<div style='clear:both;'></div>";
            }
          }
         }else {
           echo "0 resultados encontrados";
         } 
        
        ?>
              

        <!--eBooks con descripción
        <div class="ebook">
          <a href="https://www.amazon.es/Cell-Stephen-King-ebook/dp/B009MBC26I"><img src="../img/cell.jpeg" alt="ebook 1">
          <div>A través de los teléfonos móviles se envía un mensaje que convierte a todos en esclavos asesinos...</div>
        </div></a>
        <div class="ebook">
          <a href="https://www.amazon.es/El-ciclo-del-hombre-lobo-ebook/dp/B0062XE87K"> <img src="../img/elciclodelhombrelobo.jpeg" alt="ebook 2">
          <div>Una escalofriante revisión del mito del hombre lobo por el rey de la literatura de terror...</div>
        </div></a>
        <div class="ebook">
          <a href="https://www.amazon.es/El-resplandor-Stephen-King-ebook/dp/B007TID0R6"> <img src="../img/elresplandor.jpeg" alt="ebook 3">
        <div>Esa es la palabra que Danny había visto en el espejo. Y, aunque no sabía leer, entendió que era un mensaje de horror...</div>
        </div></a>
        <div class="ebook">
          <a href="https://www.amazon.es/El-resplandor-Stephen-King-ebook/dp/B007TID0R6"><img src="../img/doctorsleep.jpeg" alt="ebook 4">
        <div>Una novela que entusiasmará a los millones de lectores de El resplandor y que encantará...</div>
        </div></a>-->
      </div>
      <div class="column right">
      <?php

      // 2. Selección y muestra de datos de la base de datos 
      $result = mysqli_query($conn, "SELECT Books.Title FROM Books WHERE Top = '1'");
      
      if (!empty ($result) && mysqli_num_rows($result) > 0){
        //datos de la salida de cada fila (fila=row)
        while ($row = mysqli_fetch_array($result)) {
          //Añadismos la imagen de la página con la etiqueta img de HTML
          echo "<p>".$row['Title']."</p><br>";
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
