<?php include('../../../conexion.php')?>
<?php include('../../../template/cabecera.php')?>
<?php 
    if(isset($_GET['txtId'])){
        $id = (isset($_GET['txtId']))?$_GET['txtId']:""; 

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_configuraciones` WHERE id = :id");
        $sentencia->bindParam(":id",$id);
        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);

        $nombre = $registro['nombre'];
        $valor = $registro['valor'];
    }

    if($_POST){
        $id = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
        $nombre = (isset($_POST['txtnombre'])) ? $_POST['txtnombre'] : "";
        $valor = (isset($_POST['txtvalor'])) ? $_POST['txtvalor'] : "";

        $sentencia = $conexion->prepare("UPDATE `tbl_configuraciones` SET nombre=:nombre, valor=:valor WHERE id=:id");
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":valor", $valor);
        $sentencia->bindParam(":id", $id);
        $sentencia->execute();

        $message = "Registro actualizado";
        header("Location:index.php?message=".$message);
    }
    
?>

<div class="container">
    <div class="card">
        <div class="card-header">Configuraciones</div>
        <div class="card-body">
            <form action="editar.php" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">ID:</label>
                    <input type="text" class="form-control" name="txtId" value="<?php echo $id?>" aria-describedby="helpId" readonly>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="txtnombre" value="<?php echo $nombre?>"  aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Valor:</label>
                    <input type="text" class="form-control" name="txtvalor" value="<?php echo $valor?>" aria-describedby="helpId">
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>
