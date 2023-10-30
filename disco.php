<?php

$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }

    
    echo '<h2>Lista de canciones del album: '.$_GET['titulo'].'</h2>';
  
    echo "<table border='1'>";
    echo "<tr><th>Título</th><th>Album</th><th>Posición</th><th>Duración</th><th>Género</th></tr>";
if(isset($_GET['codigo'])){
    $codDisco = $_GET['codigo'];
    $consulta = $discografia->query("SELECT * FROM cancion WHERE album = '$codDisco' ORDER BY posicion");
    while($row = $consulta->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>" . $row['titulo'];
        echo "<td>" . $row['album'];
        echo "<td>" . $row['posicion'];
        echo "<td>" . $row['duracion'];
        echo "<td>" . $row['genero'];
    
    }
    echo "</tr>";

    echo '<h4><a href="cancionnueva.php?codigo='. $_GET['codigo'].'&titulo='.$_GET['titulo'].'">'."Agregar nueva canción" .'</a>';
    echo '<h4><a href="borrardisco.php?codigo='. $_GET['codigo'].'&titulo='.$_GET['titulo'].'">'."Eliminar el disco" .'</a>';
    }




?>