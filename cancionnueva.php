<?php

if (isset($_SESSION['nombre'])) {

    $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }

    echo '<h2>Añadir Nueva Canción al disco ' . $_GET['titulo'] . '</h2>';
    echo '<form method="POST">';
    echo '<label>Título:</label> <input type="text" name="titulo" required><p>';
    echo '<label>Posición:</label> <input type="text" name="posicion" required disabled><p>';
    echo '<label>Duración:</label> <input type="text" name="duracion" required><p>';
    echo '<label>Género:</label> <input type="text" name="genero" required><p>';
    echo '<input type="submit" value="Agregar Canción">';
    echo '</form>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $duracion = $_POST['duracion'];
        $genero = $_POST['genero'];
        $album = $_GET['codigo'];


        if (empty($titulo)  && empty($duracion) && empty($genero) && empty($codigo)) {
            echo 'El formulario no tiene informacion';
        } else {

            $consulta = $discografia->query("SELECT MAX(posicion) AS max_posicion FROM cancion WHERE album = '" . $_GET['codigo'] . "'");
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $nuevaPosicion = $row["max_posicion"] + 1;
                $nuevaConsulta = $discografia->query("INSERT INTO `cancion` (`titulo`, `album`, `posicion`, `duracion`, `genero`) VALUES ('$titulo','$album', '$nuevaPosicion', '$duracion', '$genero')");
            }
            echo 'Canción añadida :)';
        }
    }
} else {
    header('Location:login.php');
}
