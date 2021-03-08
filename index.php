<html>
  <head>
    <title>Arbol</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js "></script>
    <link rel="stylesheet" href="css/index2.css">
  </head>

  <body>
    <?php

      function busqueda($padre){
        	$conexion=mysqli_connect('localhost','root','','prueba')
          or die ("problemas al conectar");
        	//$Padre=$_POST['id_padre'];
          $resultado=mysqli_query($conexion,"SELECT nombre,identificacion FROM `dependencia`
            WHERE codigo_padre='$padre'");
          $cantidad_hijos=0;

          //generamos una cajos para sus hijos
          if ($padre!=0) {

              echo "<div class='margen'>";
          }

          while ($iter=mysqli_fetch_array($resultado)) {
            //sumamos a esta variable la cantidad de hijos que encontramos
            $cantidad_hijos+=1;
            //mensaje para conocer la codigo del padre
            echo "<br>";
            echo "<div class='responsable'>";
            echo "<p>El codigo de identificacion de su padre es: ".$padre."</p>";
            echo "</div>";
            //imprime la informacion del hijo
            echo "<p>Nombre: ".$iter[0]." y su identificacion es: ".$iter[1]."</p>";
            echo "<p>Sus hijos son: </p>";
            //busca los hijos de este hijo encontrado 
            busqueda($iter[1]);

          }
          //verifica si encontro hijos en el registro
          if ($cantidad_hijos==0) {
            echo "<p>No tiene hijos registrados</p>";

          }
          if ($padre!=0) {
              echo "</div>";
          }

          mysqli_close($conexion);
        }


    ?>
    <h1>Arbol de busqueda</h1>
    <h2>Aqui comienza</h2>
    <div class="margen">
      <?php
      $padre=0;
      busqueda($padre);
      ?>
    </div>




  </body>

</html>
