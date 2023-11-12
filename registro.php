<?php


$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
try {
    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

echo '<h2>Registro</h2>';
echo '<form method="POST">';
echo '<label>Nombre:</label> <input type="text" name="nombre" required><p>';
echo '<label>Contraseña:</label> <input type="password" name="password" required><p>';;
echo '<input type="submit" value="Registro">';
echo '</form>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];


    if (empty($nombre) && empty($password)) {
        echo "No puede haber campos vacíos";
    } else {
        $consulta = $discografia->query("INSERT INTO `tabla_usuarios`(`usuario`, `password`) VALUES ('$nombre','$password')");
        header("Location: login.php");
    }
}
