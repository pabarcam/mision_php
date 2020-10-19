
<?php
include('conexion.php');

?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Entregas</title>
        <link type="text/css" href="estilo.css" rel="stylesheet">

    </head>

    <body>
        <div class="contenedor">
            <div class= "encabezado">
                <div class="izq">
                <?php
                include('conexion.php');
                include('sesion.php');

                $rut = $_SESSION['usuario'];
                $consulta = "SELECT * FROM personal WHERE rut = '$rut'";
                $ejecutar = $mysqli->query($consulta);

                $result = mysqli_fetch_array($ejecutar);
                $nom = $result['nombre'];
                $ape = $result['apellido'];
                

                ?>

                <p>Bienvenido/a:<br><?php echo "$nom $ape"; ?></p>

                </div>

                <div class="centro">
                    <a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>
                </div>
                
                <div class="derecha">
                    <a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
                </div>
            </div>
                
            
            <br><h1 align='center'>PRODUCTOS EXISTENTES</h1><br>
            <?php
                include('conexion.php');

                $consulta="SELECT * FROM productos";
                $ejecutar=$mysqli->query($consulta);
        
                echo "<table  width='80%' align='center'><tr>";               
                echo "<th width='10%'>CODIGO PRODUCTO</th>";
                echo "<th width='20%'>DESCRIPCIÓN</th>";
                echo "<th width='10%'>STOCK</th>";
                echo "<th width='20%'>PROVEEDOR</th>";
                echo "<th width='20%'>FECHA DE INGRESO</th>";
                echo  "</tr>"; 
            
                while($result=mysqli_fetch_array($ejecutar)){    
                    
                  echo "<tr>";                
                  echo '<td width=10%>'.$result['cod_producto'].'</td>';
                  echo '<td width=20%>'.$result['descripcion'].'</td>';
                  echo '<td width=20%>'. $result['stock'].'</td>';
                  echo '<td width=20%>'.$result['proveedor'].'</td>';
                  echo '<td width=20%>'.$result['fecha_ingreso'].'</td>';
                  echo "</tr>";
                }
                 echo "</table></br>";
            ?>

            <form action="" method="post" align='center'>

                <div class="campo">
                    <label name="rut">Rut personal que retira:</label>
                    <input name='rut' type="text">
                </div>

                <div class="campo">
                    <label name="cod">Código del producto:</label>
                    <input name='codigo' type="text">
                </div>

                <div class="campo">
                    <label name="cantd">Cantidad:</label>
                    <input name='cantidad' type="text">
                </div>

                <div class="campo">
                    <label name="cantd">Fecha entrega:</label>
                    <input name='fecha' type="date">
                </div>
                
                <div class="botones">
                    <input name='agregar' type="submit" value="Agregar">
                </div>
                
            </form>

            <?php

            if(isset($_POST['agregar'])){

                $rut= $_POST['rut'];
                $codigo= $_POST['codigo'];
                $cantidad= $_POST['cantidad'];
                $fecha= $_POST['fecha'];

                $consulta = "UPDATE productos SET stock = stock - $cantidad WHERE cod_producto  = $codigo";
                $ejecutar = $mysqli->query($consulta);

                $consulta = "INSERT INTO entregas VALUES ('$rut', '$codigo', '$cantidad', '$fecha')";

                $ejecutar = $mysqli->query($consulta);

                header("Location: realizar_entrega.php");
            };

            ?>
            
        </div>
    </body>
</html> 