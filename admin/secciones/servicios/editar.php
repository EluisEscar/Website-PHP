<?php include('../../../conexion.php')?>


<?php 
    if(isset($_GET['txtId'])){
        $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_servicios` WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);

        $icono = $registro['icono'];
        $titulo = $registro['titulo'];
        $descripcion = $registro['descripcion']; 
    }

    if($_POST){

        $txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
        $icono = (isset($_POST['txtIcono'])) ? $_POST['txtIcono'] : "";
        $titulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
        $descripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";

        $sentencia = $conexion->prepare("UPDATE `tbl_servicios` SET icono=:icono, titulo=:titulo, descripcion=:descripcion WHERE id=:id");
        $sentencia->bindParam(":icono", $icono);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();

        $mensaje = "Registro actualizado correctamente";
        header("Location:index.php?mensaje=".$mensaje);
    }
?>

<?php include('../../../template/cabecera.php')?>

    <div class="container">
        <div class="card">
            <div class="card-header">Servicios</div>
            <div class="card-body">
                <form action="editar.php" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Id:</label>
                        <input type="text" class="form-control" name="txtId" aria-describedby="helpId" value="<?php echo $txtId;?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Icono:</label>
                        <input type="text" class="form-control" name="txtIcono" aria-describedby="helpId" value="<?php echo $icono;?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Titulo:</label>
                        <input type="text" class="form-control" name="txtTitulo" aria-describedby="helpId" value="<?php echo $titulo?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripcion:</label>
                        <input type="text" class="form-control" name="txtDescripcion" aria-describedby="helpId" value="<?php echo $descripcion;?>">
                    </div>
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
                </form>
            </div>
        </div>   
    </div>


