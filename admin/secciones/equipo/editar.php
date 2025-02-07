<?php include('../../../conexion.php')?>
<?php 
    if(isset($_GET['txtId'])){
        $id = (isset($_GET['txtId']))?$_GET['txtId']:"";
        
        $sentencia = $conexion->prepare("SELECT * FROM tbl_equipo WHERE id = :id");
        $sentencia->bindParam(":id",$id);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);

        $nombre = $registro['nombre'];
        $rol = $registro['rol'];
        $facebook = $registro['facebook'];
        $x = $registro['x'];
        $linkedin = $registro['linkedin'];
        $imagen = $registro['imagen'];
    }

    if($_POST){

        $id = (isset($_POST['txtId']))?$_POST['txtId']:"";
        $nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
        $rol = (isset($_POST['txtRol']))?$_POST['txtRol']:"";
        $facebook = (isset($_POST['txtFacebook']))?$_POST['txtFacebook']:"";
        $x = (isset($_POST['txtX']))?$_POST['txtX']:"";
        $linkedin = (isset($_POST['txtLinkedin']))?$_POST['txtLinkedin']:"";

        $sentencia = $conexion->prepare("UPDATE `tbl_equipo` SET `nombre` = :nombre, `rol` = :rol, `x` = :x, `facebook` = :facebook, `linkedin` = :linkedin WHERE `tbl_equipo`.`id` = :id");

        $sentencia->bindParam(":id",$id);
        $sentencia->bindParam(":nombre",$nombre);
        $sentencia->bindParam(":rol",$rol);
        $sentencia->bindParam(":x",$x);
        $sentencia->bindParam(":facebook",$facebook);
        $sentencia->bindParam(":linkedin",$linkedin);
        $sentencia->execute();

        if($_FILES['txtImagen']['tmp_name']!=""){

            $imagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
            $fecha = new DateTime();
            $nombreArchivo = ($fecha->getTimestamp()) . "_" . $_FILES['txtImagen']['name'];

            $tmp_imagen = $_FILES['txtImagen']['tmp_name'];

            move_uploaded_file($_FILES['txtImagen']['tmp_name'], "../../../assets/img/team/" . $nombreArchivo);

            $sentencia = $conexion->prepare("SELECT imagen FROM `tbl_equipo` WHERE id=:id");
            $sentencia->bindParam(":id", $txtId);
            $sentencia->execute();
            $registroImagen = $sentencia->fetch(PDO::FETCH_LAZY);

            if(file_exists("../../../assets/img/team/".$registroImagen['imagen'])){
                unlink("../../../assets/img/team/".$registroImagen['imagen']);
            }

            $sentencia = $conexion->prepare("UPDATE `tbl_equipo` SET imagen=:imagen WHERE id=:id");
            $sentencia->bindParam(":imagen", $nombreArchivo);
            $sentencia->bindParam(":id", $id);
            $sentencia->execute();
    }

    $message = "Registro actualizado";
    header("Location:index.php?message=".$message);
}
    
?>

<?php include('../../../template/cabecera.php')?>

<div class="container">
    <div class="card">
        <div class="card-header">Equipo</div>
        <div class="card-body">
            <form action="editar.php" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Id:</label>
                    <input type="text" class="form-control" name="txtId" aria-describedby="helpId" readonly value="<?php echo $registro['id']?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="txtImagen" aria-describedby="helpId" value="<?php echo $registro['imagen']?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="txtNombre" aria-describedby="helpId" value="<?php echo $registro['nombre']?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Rol:</label>
                    <input type="text" class="form-control" name="txtRol" aria-describedby="helpId" value="<?php echo $registro['rol']?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">X:</label>
                    <input type="text" class="form-control" name="txtX" aria-describedby="helpId" value="<?php echo $registro['x']?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Facebook:</label>
                    <input type="text" class="form-control" name="txtFacebook" aria-describedby="helpId" value="<?php echo $registro['facebook']?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Linkedin:</label>
                    <input type="text" class="form-control" name="txtLinkedin" aria-describedby="helpId" value="<?php echo $registro['linkedin']?>">
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>
