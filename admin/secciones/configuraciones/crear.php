<?php include('../../../conexion.php')?>
<?php 
    if($_POST){
        $id = (isset($_POST['txtId']))?$_POST['txtId']:"";
        $nombre = (isset($_POST['txtnombre']))?$_POST['txtnombre']:"";
        $valor = (isset($_POST['txtvalor']))?$_POST['txtvalor']:"";

        $sentencia = $conexion->prepare("INSERT INTO `tbl_configuraciones` (`id`, `nombre`, `valor`) 
        VALUES (NULL, :nombre, :valor)");

        $sentencia->bindParam(":nombre",$nombre);
        $sentencia->bindParam(":valor",$valor);

        $sentencia->execute();
        $mensaje = "Registro creado";
        header("Location:index.php?mensaje=".$mensaje);
    }
?>
<?php include('../../../template/cabecera.php')?>

<div class="container">
    <div class="card">
        <div class="card-header">Configuraciones</div>
        <div class="card-body">
            <form action="crear.php" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="txtnombre" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Valor:</label>
                    <input type="text" class="form-control" name="txtvalor" aria-describedby="helpId">
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>
