<!DOCTYPE html> 
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>formulario eliminar producto</title>
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
					<?php
					// La siguiente validación verifica el cargo del usuario que esta viendo esta pagina para asignarle el flujo que tendra el links con imagen "Home".
					$consulta = "SELECT cargo FROM personal WHERE rut = '$rut'";
					$ejecutar = $mysqli->query($consulta);


					$fila = $ejecutar->fetch_row();
					$cargo = $fila[0];
					
					if ($cargo=='Admin') {
									echo "<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a>";
					}else {
									echo "<a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>";
					};

					error_reporting(E_ALL  ^  E_NOTICE  ^  E_WARNING);
					?> 
				</div>
				
				<div class="derecha">
					<!-- La siguiente línea corresponde al links con imagen para finalizar sesión, que redirige a la página salir.php con la varible "sal=si" que destruye la sesión y nos 
					muestra la pagina del login. -->
					<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
				</div>
			</div>
				
			
			<br><h1 align='center'>REGISTROS EXISTENTES</h1><br>
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
			 	<label name="elimina">Ingresa el código del producto a eliminar:</label>
			 	<input name='eliminar-producto' type="text">
			 	<input name='eliminar' type="submit" value="ELIMINAR">
			</form>
			<?php 
			if (isset($_POST['eliminar'])) {
			$codigo = $_POST['eliminar-producto'];

			$consulta = "DELETE FROM productos WHERE cod_producto= $codigo";
			$ejecutar = $mysqli->query($consulta);

			header("Location:eliminar_producto.php");
			}
			?>
		    	
		</div>
	</body>
</html>		 
