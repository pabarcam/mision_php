<?php

include('conexion.php');
?>

<?php

$usuario = $_POST['usuario'];
$pass = md5($_POST['pass']);

$consulta = "SELECT * FROM personal WHERE RUT = '$usuario' AND contraseña = '$pass'";

$ejecutar = $mysqli->query($consulta)or die('Datos no encontrados.');
$resul = mysqli_num_rows($ejecutar);

$consulta = "SELECT cargo FROM personal WHERE rut = '$usuario'";
$ejecutar = $mysqli->query($consulta);


$fila = $ejecutar->fetch_row();
$cargo = $fila[0];

if ($resul > 0) {
  session_start();

    $_SESSION['activo'] = true;
    $_SESSION['usuario'] = $usuario;


    if ($cargo == 'Admin'){
        header("Location:principalAdmin.php");

    }else if ($cargo == 'Bodega') {
        header("Location:principalBodega.php");
    }
    
}else{
    header("Location: login.php?error=si");
}
?>
