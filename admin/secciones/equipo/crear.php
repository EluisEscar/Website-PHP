<?php include('../../../conexion.php')?>
<?php
    if($_POST){
        $nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
        $rol = (isset($_POST['txtRol']))?$_POST['txtRol']:"";
        $facebook = (isset($_POST['txtFacebook']))?$_POST['txtFacebook']:"";
        $x = (isset($_POST['txtX']))?$_POST['txtX']:"";
        $linkedin = (isset($_POST['txtLinkedin']))?$_POST['txtLinkedin']:"";

        $imagen = (isset($_POST['txtImagen']))?$_POST['txtImagen']:"";

        $fechaImagen = new DateTime();
        $nombreArchivo = ($fechaImagen->getTimestamp()) . "_" . $_FILES['txtImagen']['name'];

        $tmp_imagen = $_FILES['txtImagen']['tmp_name'];
        if($tmp_imagen!=""){
            move_uploaded_file($tmp_imagen, "../../../assets/img/team/" . $nombreArchivo);
        }
       
        $sentencia = $conexion->prepare("INSERT INTO tbl_equipo (nombre, rol, facebook, x, linkedin, imagen) 
        VALUES (:nombre, :rol, :facebook, :x, :linkedin, :imagen)");

        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':rol', $rol);
        $sentencia->bindParam(':facebook', $facebook);
        $sentencia->bindParam(':x', $x);
        $sentencia->bindParam(':linkedin', $linkedin);
        $sentencia->bindParam(':imagen', $nombreArchivo);

        $sentencia->execute();
        $mensaje = "Registro creado";
        header("Location:index.php?mensaje=".$mensaje);
    }
?>
<?php include('../../../template/cabecera.php')?>

<div class="container">
    <div class="card">
        <div class="card-header">Equipo</div>
        <div class="card-body">
            <form action="crear.php" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="txtImagen" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="txtNombre" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Rol:</label>
                    <input type="text" class="form-control" name="txtRol" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">X:</label>
                    <input type="text" class="form-control" name="txtX" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Facebook:</label>
                    <input type="text" class="form-control" name="txtFacebook" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Linkedin:</label>
                    <input type="text" class="form-control" name="txtLinkedin" aria-describedby="helpId">
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>


