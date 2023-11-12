<?php
session_start();


$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
try {
    $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

$usuario = 'Nuria';
$pass = 'contraseña98';

$usuario = 'Manolo';
$pass = 'garciaLopez';

$usuario = 'Amparo';
$pass = '123456';

$usuario = 'Lola';
$pass = 'miContraseña';

$usuario = 'Miguel';
$pass = 'AlbaceteTe';



$salt = '$2y$12$';
$salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9), array('/', '.'));
for ($i = 0; $i < 22; $i++) $salt .= $salt_chars[array_rand($salt_chars)];
$hash = crypt($pass, $salt);
//echo $hash;


$consulta = $discografia->query("INSERT INTO `tabla_usuarios` (`usuario`, `password`) VALUES ('$usuario','$hash')");


echo '<h2>Usuarios</h2>';
echo '<form method="POST">';
echo '<label>Nombre:</label> <input type="text" name="nombre" required><p>';
echo '<label>Contraseña:</label> <input type="password" name="password" required><p>';
echo '<input type="submit" value="Entrar">';
echo '</form>';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];

    if (empty($nombre) || empty($password)) {
        echo 'Introduce información';
    }
}


$consulta = $discografia->prepare("SELECT * FROM tabla_usuarios WHERE usuario = :nombre");
$consulta->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$consulta->execute();


if ($usuarioEncontrado = $consulta->fetch()) {
    if (password_verify($password, $usuarioEncontrado['password'])) {
        $_SESSION['nombre'] = $usuario;
        //header("Location: index.php");
    } else {
        echo "Contraseña incorrecta. Inténtalo de nuevo.";
    }
} else {
    echo "<a href='registro.php?'>Regístrate si no tienes una cuenta.</a>";
}


setcookie('nombre', $nombre);
if (isset($_COOKIE['nombre']) && $_COOKIE['nombre'] == $nombre) {
    header("Location: acceder.php?nombre='" . $_COOKIE['nombre'] . "'");
}






/*
    echo '<h2>Infromación del usuario</h2>';
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Contraseña</th></tr>";
    $consulta = $discografia->query("SELECT * FROM tabla_usuarios WHERE usuario = '$nombre'");
    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['nombre'];
        echo "<td>" . $row['password'];

        var_dump($row['nombre']);
        var_dump($row['password']);
    }
    echo "</tr>";
}
*/
