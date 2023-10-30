<?php

$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $discografia = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }

echo '<h2>Lista de albumes</h2>';
echo "<table border='1'>";
echo "<tr><th>Código</th><th>Título</th><th>Discografía</th><th>Formato</th><th>Fecha de lanzamiento</th><th>Fecha de compra</th><th>Precio</th></tr>";
$consulta = $discografia->query('SELECT * FROM album');
while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . '<a href="disco.php?codigo='. $row['codigo'].'&titulo='.$row['titulo'].'">'.$row['codigo'] .'</a>';
    echo "<td>" . $row['titulo'];
    echo "<td>" . $row['discografia'];
    echo "<td>" . $row['formato'];
    echo "<td>" . $row['fechaLanzamiento'];
    echo "<td>" . $row['fechaCompra'];
    echo "<td>" . $row['precio'];
}
echo "</tr>";

echo '<h4><a href="disconuevo.php?">'."Añadir un disco nuevo".'</a>';
echo '<h4><a href="canciones.php">'."Buscar canciones".'</a>';




?>