<?php
session_start();
if (isset($_SESSION['nombre'])) {


    $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }

    echo '<h2>Añadir un nuevo disco</h2>';
    echo '<form method="POST">';
    echo '<label>Título:</label> <input type="text" name="titulo" required><p>';
    echo '<label>Discografía:</label> <input type="text" name="discografia" required><p>';
    echo '<label>Formato:</label> 
            <input type="radio" name="formato" value="vinilo">Vinilo
            <input type="radio" name="formato" value="cd">CD
            <input type="radio" name="formato" value="dvd">DVD
            <input type="radio" name="formato" value="mp3"> MP3<p>';
    echo '<label>Fecha de Lanzamiento:</label> <input type="text" name="fechaLanzamiento" required><p>';
    echo '<label>Fecha de Compra:</label> <input type="text" name="fechaCompra" required><p>';
    echo '<label>Precio:</label> <input type="text" name="precio" required><p>';
    echo '<input type="submit" value="Añadir disco">';
    echo '</form>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $discografiaAlbum = $_POST['discografia'];
        $formato = $_POST['formato'];
        $fechaLanzamiento = $_POST['fechaLanzamiento'];
        $fechaCompra = $_POST['fechaCompra'];
        $precio = $_POST['precio'];


        if (empty($titulo) || empty($discografiaAlbum) || empty($formato) || empty($fechaLanzamiento) || empty($fechaCompra) || empty($precio)) {
            echo 'El formulario no tiene datos';
        } else {

            $consulta = $discografia->query("INSERT INTO `album`(`titulo`, `discografia`, `formato`, `fechaLanzamiento`, `fechaCompra`, `precio`) VALUES ('$titulo','$discografiaAlbum','$formato','$fechaLanzamiento','$fechaCompra','$precio')");
            echo 'Disco añadido con éxito';
            echo '<h4><a href="index.php?">Volver a la pagina de inicio</a>';
        }
    }
} else {
    header('Location:login.php');
}
