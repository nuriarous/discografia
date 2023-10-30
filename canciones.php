<?php

$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
try {
    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

echo '<h2>Búsqueda de canciones</h2>';
echo '<form method="POST">';
echo '<label>Texto a buscar:</label> <input type="text" name="texto" required><p>';
echo '<label>Buscar en:  </label> 
            <input type="radio" name="buscar" value="cancion">Títulos de canción
            <input type="radio" name="buscar" value="disco">Nombre de álbum
            <input type="radio" name="buscar" value="ambos">Ambos campos<p>';
echo 'Género musical: <select name="genero" ">
                        <option>Clásica</option>
                        <option>BSO</option>
                        <option>Blues</option>
                        <option>Electrónica</option>
                        <option>Jazz</option>
                        <option>Metal</option>
                        <option>Pop</option>
                        <option>Rock</option><p>';
echo '<input type="submit" value="Buscar"><p>';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['texto'];
    $buscar = $_POST['buscar'];


    $consulta = $discografia->query("SELECT * FROM cancion WHERE titulo LIKE '$texto'");
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
        if ($buscar == 'cancion') {
            echo 'Cancion encontrada: ' . $row['titulo'];
        }

        $consulta = $discografia->query("SELECT * FROM `album` WHERE titulo LIKE '$texto'");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if ($buscar == 'disco') {
                echo 'Cancion encontrada: ' . $row['titulo'];
            }
        }
        $consulta = $discografia->query("SELECT * FROM `cancion` WHERE titulo LIKE '$texto'");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if ($buscar == 'ambos') {
                echo 'Cancion encontrada: ' . $row['titulo'].'<p>';
            }
        }

        $consulta = $discografia->query("SELECT * FROM `album` WHERE titulo LIKE '$texto'");
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if ($buscar == 'ambos') {
                echo 'Album  encontrado: ' . $row['titulo'];
            }
        }
    }
}
