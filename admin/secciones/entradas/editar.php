<?php include('../../../conexion.php')?>
<?php 
    if(isset($_GET['txtId'])){
        $txtId = (isset($_GET['txtId']))?$_GET['txtId']:""; 

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_entradas` WHERE id=:id");
        $sentencia->bindParam(":id",$txtId);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $fecha = $registro['fecha'];
        $titulo = $registro['titulo'];
        $descripcion = $registro['descripcion'];
        $imagen = $registro['imagen'];
    }

    if($_POST){

        $txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
        $fecha = (isset($_POST['txtFecha'])) ? $_POST['txtFecha'] : "";
        $titulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
        $descripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
    
        $sentencia = $conexion->prepare("UPDATE `tbl_entradas` SET fecha=:fecha, titulo=:titulo, descripcion=:descripcion WHERE id=:id");

        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();

        if($_FILES['txtImagen']['tmp_name']!=""){

            $imagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
            $fecha = new DateTime();
            $nombreArchivo = ($fecha->getTimestamp()) . "_" . $_FILES['txtImagen']['name'];

            $tmp_imagen = $_FILES['txtImagen']['tmp_name'];

            move_uploaded_file($_FILES['txtImagen']['tmp_name'], "../../../assets/img/about/" . $nombreArchivo);

            $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_entradas` WHERE id=:id");
            $sentencia->bindParam(":id", $txtId);
            $sentencia->execute();
            $registroImagen = $sentencia->fetch(PDO::FETCH_LAZY);

            if(file_exists("../../../assets/img/about/".$registroImagen['imagen'])){
                unlink("../../../assets/img/about/".$registroImagen['imagen']);
            }

            $sentencia = $conexion->prepare("UPDATE `tbl_entradas` SET imagen=:imagen WHERE id=:id");
            $sentencia->bindParam(":imagen", $nombreArchivo);
            $sentencia->bindParam(":id", $txtId);
            $sentencia->execute();
    }

    $message = "Registro actualizado";
    header("Location:index.php?message=".$message);
}
?>

<?php include('../../../template/cabecera.php')?>

<div class="container">
    <div class="card">
        <div class="card-header">Entradas</div>
        <div class="card-body">
            <form action="editar.php" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID:</label>
                    <input type="text" class="form-control" name="txtId" aria-describedby="helpId" value="<?php echo $txtId;?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Fecha:</label>
                    <input type="text" class="form-control" name="txtFecha" value="<?php echo $fecha?>" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Titulo:</label>
                    <input type="text" class="form-control" name="txtTitulo" value="<?php echo $titulo?>" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripcion:</label>
                    <input type="text" class="form-control" name="txtDescripcion" value="<?php echo $descripcion?>" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="txtImagen" value="<?php echo $imagen?>" aria-describedby="helpId">
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>
