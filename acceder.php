<?php
session_start();

$nombreUsuario = $_COOKIE['nombre'];
echo '<h2>¿Desea acceder como ' . $nombreUsuario . '?</h2>';
echo '<form method="POST">';
echo '<input type="submit" name="respuesta" value="No">';
echo '<input type="submit" name="respuesta" value="Si">';
echo '</form>';

$_SESSION['nombre'] = $nombreUsuario;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['respuesta']) && $_POST['respuesta'] == 'Si') {
        header("Location: index.php");
    } elseif (isset($_POST['respuesta']) && $_POST['respuesta'] == 'No') {
        setcookie('nombre', '', time() - 3600);
        setcookie('password', '', time() - 3600);
        header("Location: login.php");
    }
}
