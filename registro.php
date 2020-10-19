<?php

include ('conexion.php');

$codigo= $_POST['codigo'];
$descripcion= $_POST['descripcion'];
$stock= $_POST['stock'];
$proveedor= $_POST['proveedor'];
$fecha= $_POST['fecha'];


$consulta = "SELECT * FROM productos WHERE cod_producto = '$codigo'";
$ejecutar = $mysqli->query($consulta);
$resul =  mysqli_num_rows($ejecutar);

if($resul == 0){
    $consulta = "INSERT INTO productos (cod_producto, descripcion, stock, proveedor, fecha_ingreso) VALUES
    ('$codigo', '$descripcion', '$stock', '$proveedor', '$fecha')";

    $ejecutar = $mysqli->query($consulta) or die ('No se puede crear el producto');
    header("Location: agregar_producto.php?valida=si");
}else{
    header("Location. agregar_producto.php?erronea=si");
}

?>