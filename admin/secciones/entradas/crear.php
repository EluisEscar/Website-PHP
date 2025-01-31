<?php include('../../../template/cabecera.php')?>
<?php include('../../../conexion.php')?>
<?php
    if($_POST){
        $fecha = (isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
        $titulo = (isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
        $descripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
        $imagen = (isset($_POST['txtImagen']))?$_POST['txtImagen']:"";

        $fechaImagen = new DateTime();
        $nombreArchivo = ($fechaImagen->getTimestamp()) . "_" . $_FILES['txtImagen']['name'];

        $tmp_imagen = $_FILES['txtImagen']['tmp_name'];
        if($tmp_imagen!=""){
            move_uploaded_file($tmp_imagen, "../../../assets/img/about/" . $nombreArchivo);
        }
       
        $sentencia = $conexion->prepare("INSERT INTO `tbl_entradas` (`id`, `fecha`, `titulo`, `descripcion`, `imagen`) 
        VALUES (NULL, :fecha , :titulo , :descripcion, :imagen)");

        $sentencia->bindParam(":fecha",$fecha);
        $sentencia->bindParam(":titulo",$titulo);
        $sentencia->bindParam(":descripcion",$descripcion);
        $sentencia->bindParam(":imagen",$nombreArchivo);

        $sentencia->execute();
        $mensaje = "Registro creado";
        header("Location:index.php?mensaje=".$mensaje);
    }
?>
<?php include('../../../template/cabecera.php')?>

<div class="container">
    <div class="card">
        <div class="card-header">Entradas</div>
        <div class="card-body">
            <form action="crear.php" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Fecha:</label>
                    <input type="text" class="form-control" name="txtFecha" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Titulo:</label>
                    <input type="text" class="form-control" name="txtTitulo" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripcion:</label>
                    <input type="text" class="form-control" name="txtDescripcion" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="txtImagen" aria-describedby="helpId">
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>


