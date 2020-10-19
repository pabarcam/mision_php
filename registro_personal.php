<?php

include("conexion.php");

$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cargo = $_POST['cargo'];
$contra1 = $_POST['contrasena1'];
$contra2 = $_POST['contrasena2'];

if($contra1 == $contra2){
  $consulta = "SELECT * FROM personal WHERE rut = '$rut'";
  $ejecutar = $mysqli->query($consulta);
  $resul = mysqli_num_rows($ejecutar);

  if($resul == 0){
    $consulta = "INSERT INTO personal(rut, nombre, apellido, cargo, contraseña)
                  VALUES('$rut','$nombre','$apellido', '$cargo', MD5('$contra1'))";

    $ejecutar = $mysqli->query($consulta)or die
    ("no se puedo crear registro");

    header("Location: crear_personal.php?valida=si");

  }else{
    header("Location: crear_personal.php?erronea=si");
  }  
}else{
    header("Location: crear_personal.php?distintas=si");
}

?>