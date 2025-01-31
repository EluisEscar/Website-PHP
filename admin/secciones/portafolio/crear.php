<?php include('../../../conexion.php')?>
<?php
    if($_POST){
        $titulo = (isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
        $subtitulo = (isset($_POST['txtSubtitulo']))?$_POST['txtSubtitulo']:"";  
        $descripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
        $cliente = (isset($_POST['txtCliente']))?$_POST['txtCliente']:"";
        $imagen = (isset($_POST['txtImagen']))?$_POST['txtImagen']:"";
        $categoria = (isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";
        $url = (isset($_POST['txtUrl']))?$_POST['txtUrl']:"";
        
        $fecha = new DateTime();
        $nombreArchivo = ($fecha->getTimestamp()) . "_" . $_FILES['txtImagen']['name'];

        $tmp_imagen = $_FILES['txtImagen']['tmp_name'];
        if($tmp_imagen!=""){
            move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombreArchivo);
        }
       
        $sentencia = $conexion->prepare("INSERT INTO `tbl_portafolio` (`id`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) 
        VALUES (NULL, :titulo , :subtitulo , :imagen, :descripcion, :cliente, :categoria, :url)");
       

        $sentencia->bindParam(":titulo",$titulo);
        $sentencia->bindParam(":subtitulo",$subtitulo);
        $sentencia->bindParam(":imagen",$nombreArchivo);
        $sentencia->bindParam(":descripcion",$descripcion);
        $sentencia->bindParam(":cliente",$cliente);
        $sentencia->bindParam(":categoria",$categoria);
        $sentencia->bindParam(":url",$url);

        $sentencia->execute();
        $mensaje = "Registro creado";
        header("Location:index.php?mensaje=".$mensaje);
    }   
?>
<?php include('../../../template/cabecera.php')?>

<div class="container">
    <div class="card">
        <div class="card-header">Producto del portafolio</div>
        <div class="card-body">
            <form action="crear.php" enctype="multipart/form-data"  method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Titulo:</label>
                    <input type="text" class="form-control" name="txtTitulo" aria-describedby="helpId" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Subtitulo:</label>
                    <input type="text" class="form-control" name="txtSubtitulo" aria-describedby="helpId" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="txtImagen" aria-describedby="helpId" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" name="txtDescripcion" aria-describedby="helpId" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Cliente:</label>
                    <input type="text" class="form-control" name="txtCliente"  aria-describedby="helpId" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Categoría:</label>
                    <input type="text" class="form-control" name="txtCategoria" aria-describedby="helpId" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">URL:</label>
                    <input type="text" class="form-control" name="txtUrl" aria-describedby="helpId" placeholder=""/>
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>

