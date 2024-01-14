<?php
include "modelo/conexion.php";
session_start();

if(empty($_SESSION['id'])){
    header("location: login.php");
}

$editar = false;
$mensaje = "";
if(!empty($_REQUEST['mensaje'])){
    $mensaje = $_REQUEST['mensaje'];
    if($mensaje == "editando"){
        $editar = true;
    }
}
$validar = true;
if(!empty($_REQUEST['pagina'])){
    if($_REQUEST['pagina'] == "true"){
        $validar = false;
    }
}

if($validar){
    $nom = "productos";
}else{
    $nom = "productosTendencia";
}

if(!empty($_REQUEST['id']) and !empty($_REQUEST['nombre'])){
    $id = $_REQUEST['id'];
    $nom = $_REQUEST['nombre'];
}

$sql = $connection->query("SELECT * FROM productos");
$sql1 = $connection->query("SELECT * FROM productosTendencia");

?>

<!doctype html>
<html lang="es">
<head>
    <title>CRUD php y mysql b5</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid bg-warning">
        <div class="row">
            <div class="col-md">
                <header class="py-3">
                    <h3 class="text-center">CRUD de Productos</h3>
                    <a class="btn btn-primary" href="controlador/con_cerrar_sesion.php">Salir</a>
                </header>
            </div>
        </div>
    </div>
    <?php if(!$editar):?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <!-- inicio alerta -->
                    <?php if($mensaje == "editado"):?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Cambiado!</strong> Los datos fueron actualizados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif;?>
                    <?php if($mensaje == "eliminado"):?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Eliminado!</strong> Los datos fueron borrados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif;?>
                    <?php if($mensaje == "error"):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Vuelve a intentar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif;?>
                    <!-- fin alerta -->
                    <div class="card">
                        <div class="card-header">
                            Lista de personas
                        </div>
                        <div class="p-4">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Imagen</th>
                                        <th scope="col" colspan="2">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($validar):?>
                                        <?php while($dato = $sql->fetch_assoc()):?>
                                                <tr>
                                                    <td scope="row"><?php echo $dato['ID']; ?></td>
                                                    <td><?php echo $dato['nombre']; ?></td>
                                                    <td><?php echo $dato['precio']; ?></td>
                                                    <td><?php echo $dato['cantidad']; ?></td>
                                                    <td><img height="150px" src="data:image/png;base64,<?php echo base64_encode($dato['imagen']); ?>"/></td>
                                                    <td><a class="text-success" href="?mensaje=editando&id=<?php echo $dato['ID']?>&nombre=productos"><i class="bi bi-pencil-square"></i></a></td>
                                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="controlador/con_eliminar_producto.php?id=<?php echo $dato['ID'];?>&nombre=productos"><i class="bi bi-trash"></i></a></td>
                                                </tr>
                                        <?php endwhile;?>
                                    <?php else:?>
                                        <?php while($dato = $sql1->fetch_assoc()):?>
                                                <tr>
                                                    <td scope="row"><?php echo $dato['ID']; ?></td>
                                                    <td><?php echo $dato['nombre']; ?></td>
                                                    <td><?php echo $dato['precio']; ?></td>
                                                    <td><?php echo $dato['cantidad']; ?></td>
                                                    <td><img height="150px" src="data:image/png;base64,<?php echo base64_encode($dato['imagen']); ?>"/></td>
                                                    <td><a class="text-success" href="?mensaje=editando&id=<?php echo $dato['ID']?>&nombre=productosTendencia"><i class="bi bi-pencil-square"></i></a></td>
                                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="controlador/con_eliminar_producto.php?id=<?php echo $dato['ID'];?>&nombre=productosTendencia"><i class="bi bi-trash"></i></a></td>
                                                </tr>
                                        <?php endwhile;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                            <?php if($validar):?>
                                <a class="btn btn-primary" href="crud.php?pagina=true" class="text-success">Siguiente</a>
                                <br><br><br>
                            <?php else:?>
                                <a class="btn btn-primary" href="crud.php?pagina=false" class="text-success">Atrás</a>
                                <br><br><br>
                                <?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Ingreso de datos:
                        </div>
                        <form class="p-4" method="POST" enctype="multipart/form-data">
                            <?php
                                include "controlador/con_guardar_producto.php";
                            ?>
                            <div class="mb-3">
                                <label class="form-label">Nombre: </label>
                                <input type="text" class="form-control" name="txtNombre" autofocus >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Costo: </label>
                                <input type="text" class="form-control" name="txtCosto" autofocus >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cantidad: </label>
                                <input type="number" class="form-control" name="txtCantidad" autofocus >
                            </div>
                            <div class="mb-3">
                                <label class="form-file">Imagen: </label>
                                <input type="file" name="imagen" class="form-control" autofocus/>
                            </div>
                            <div class="d-grid">
                                <input type="hidden" name="bd" value="<?php echo $nom;?>">
                                <input type="submit" class="btn btn-primary" name="btnRegistrar" value="Registrar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else:?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Editar datos:
                        </div>
                        <?php
                            $sql = $connection->query("SELECT * FROM $nom WHERE ID = '$id'");
                            if($dato = $sql->fetch_object()):
                        ?>
                            <form class="p-4" method="POST" enctype="multipart/form-data">
                                <?php
                                include "controlador/con_editar_producto.php";
                                ?>
                                <div class="mb-3">
                                    <label class="form-label">Nombre: </label>
                                    <input type="text" class="form-control" name="txtNombre" required 
                                    value="<?php echo $dato->nombre; ?>"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Precio: </label>
                                    <input type="text" class="form-control" name="txtPrecio" autofocus required
                                    value="<?php echo $dato->precio; ?>"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cantidad: </label>
                                    <input type="number" class="form-control" name="txtCantidad" autofocus required
                                    value="<?php echo $dato->cantidad; ?>"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Imagen: </label>
                                    <img height="150px" src="data:image/png;base64,<?php echo base64_encode($dato->imagen); ?>"/>
                                    <input type="file" class="form-control" name="imagen" required>
                                </div>
                                <div class="d-grid">
                                    <input type="hidden" name="id" value="<?php echo $dato->ID; ?>"/>
                                    <input type="hidden" name="bd" value="<?php echo $nom; ?>"/>
                                    <input type="submit" class="btn btn-primary" value="Editar" name="btnEditar"/>
                                </div>
                            </form>
                        <?php endif;?>
                        <a href="crud.php" class="btn btn-primary">Salir</a>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
</body>

<footer class="container-fluid bg-dark fixed-bottom">
        <div class="row">
            <div class="col-md text-light text-center py-3">
                ©2023, Caperucita M&M - Todos los derechos reservados
            </div>
        </div>
</footer>
    
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>