<?php include('../../../conexion.php')?>
<?php 
    if(isset($_GET['txtId'])){
        $txtId = (isset($_GET['txtId']))?$_GET['txtId']:""; 

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_portafolio` WHERE id=:id");
        $sentencia->bindParam(":id",$txtId);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $titulo = $registro['titulo'];
        $subtitulo = $registro['subtitulo'];
        $imagen = $registro['imagen'];
        $descripcion = $registro['descripcion'];
        $cliente = $registro['cliente'];
        $categoria = $registro['categoria'];
        $url = $registro['url'];  
    }

    if($_POST){

        $txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
        $titulo = (isset($_POST['txtTitulo'])) ? $_POST['txtTitulo'] : "";
        $subtitulo = (isset($_POST['txtSubtitulo'])) ? $_POST['txtSubtitulo'] : "";
        $descripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
        $cliente = (isset($_POST['txtCliente'])) ? $_POST['txtCliente'] : "";
        $categoria = (isset($_POST['txtCategoria'])) ? $_POST['txtCategoria'] : "";
        $url = (isset($_POST['txtUrl'])) ? $_POST['txtUrl'] : "";

        $sentencia = $conexion->prepare("UPDATE `tbl_portafolio` SET titulo=:titulo, subtitulo=:subtitulo, descripcion=:descripcion, cliente=:cliente, categoria=:categoria, url=:url WHERE id=:id");
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":subtitulo", $subtitulo);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":cliente", $cliente);
        $sentencia->bindParam(":categoria", $categoria);
        $sentencia->bindParam(":url", $url);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
    
        if($_FILES['txtImagen']['tmp_name']!=""){
            
            $imagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
            $fecha = new DateTime();
            $nombreArchivo = ($fecha->getTimestamp()) . "_" . $_FILES['txtImagen']['name'];

            $tmp_imagen = $_FILES['txtImagen']['tmp_name'];

            move_uploaded_file($_FILES['txtImagen']['tmp_name'], "../../../assets/img/portfolio/" . $nombreArchivo);

            $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_portafolio` WHERE id=:id");
            $sentencia->bindParam(":id", $txtId);
            $sentencia->execute();
            $registroImagen = $sentencia->fetch(PDO::FETCH_LAZY);

            if(file_exists("../../../assets/img/portfolio/".$registroImagen['imagen'])){
                unlink("../../../assets/img/portfolio/".$registroImagen['imagen']);
            }

            $sentencia = $conexion->prepare("UPDATE `tbl_portafolio` SET imagen=:imagen WHERE id=:id");
            $sentencia->bindParam(":imagen", $nombreArchivo);
            $sentencia->bindParam(":id", $txtId);
            $sentencia->execute();
        }

        $mensaje = "Registro actualizado correctamente";
        header("Location:index.php?mensaje=".$mensaje);
    }

?>
<?php include('../../../template/cabecera.php')?>

<div class="container">
    <div class="card">
        <div class="card-header">Producto del portafolio</div>
        <div class="card-body">
            <form action="editar.php" enctype="multipart/form-data"  method="post">            
                <div class="mb-3">
                    <label for="titulo" class="form-label">ID:</label>
                    <input type="text" class="form-control" name="txtId" aria-describedby="helpId" value="<?php echo $txtId;?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="titulo" class="form-label">Titulo:</label>
                    <input type="text" class="form-control" name="txtTitulo" aria-describedby="helpId" value="<?php echo $titulo;?>">
                </div>
                <div class="mb-3">
                    <label for="subtitulo" class="form-label">Subtitulo:</label>
                    <input type="text" class="form-control" name="txtSubtitulo" aria-describedby="helpId" value="<?php echo $subtitulo;?>"/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="txtImagen" aria-describedby="helpId" value="<?php echo $imagen;?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" name="txtDescripcion" aria-describedby="helpId" value="<?php echo $descripcion;?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Cliente:</label>
                    <input type="text" class="form-control" name="txtCliente"  aria-describedby="helpId" value="<?php echo $cliente;?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Categoría:</label>
                    <input type="text" class="form-control" name="txtCategoria" aria-describedby="helpId" value="<?php echo $categoria;?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">URL:</label>
                    <input type="text" class="form-control" name="txtUrl" aria-describedby="helpId" value="<?php echo $url;?>">
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>

