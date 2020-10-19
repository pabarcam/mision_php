<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Agregar productos</title>
        <link rel="stylesheet" href="estilo.css"/>
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
                }else{
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
        <br><h1 align="center">GESTIÓN DE PRODUCTOS</h1>     

            <div class="formulario">
                <form name="registro" method="post" action="registro.php" enctype="application/x-www-form-urlencoded">
                    <div class="campo">
                        <label for="codigo">Código del producto:</label>
                        <input type="text" name="codigo" required/>
                    </div>

                    
                    <div class="campo">
                        <label for="nombre">Descripción:</label>
                        <input type="text" name="descripcion" required/>
                    </div>

                    <div class="campo">
                        <label for="stock">Stock:</label>
                        <input type="number" name="stock" required/>
                    </div>
                    

                    <div class="campo">
                        <label for="proveedor">Proveedor:</label>
                        <input type="text" name="proveedor" required/>
                    </div>

                    <div class="campo">
                        <label for="fecha">Fecha ingreso:</label>
                        <input type="date" name="fecha" required/>
                    </div>

                    <div class="botones">
                        <input type="submit" name="crear" value="Agregar producto"/>
                    </div>

                    <?php
                    if($_GET["erronea"] == "si"){
                        echo "<p class='mensaje'> El codigo del producto ya existe </p>";

                    }else if($_GET["valida"] == "si"){
                        echo "<p class='mensaje'> Producto agregado correctamente</p>";
                    }

                    ?>
                    </div>
                </form>
            </div>

        </div>
    </body>
</html>