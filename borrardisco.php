<?php

if (!isset($_SESSION['nombre'])) {


    $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }


    $ok = true;
    $discografia->beginTransaction();

    $codigo = $_GET['codigo'];
    $titulo = $_GET['titulo'];
    $consulta1 = $discografia->query("DELETE FROM cancion WHERE album = '$codigo'");
    $consulta2 = $discografia->query("DELETE FROM album WHERE codigo = '$codigo'");

    if ($ok) {
        $discografia->commit();
        echo 'Disco ' . $titulo . ' eliminado';
    } else {
        $discografia->rollback();
    }

    echo '<h4><a href="index.php?">' . "Volver a la página principal" . '</a>';
} else {
    header('Location:login.php');
}
