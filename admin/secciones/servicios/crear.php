<?php include('../../../conexion.php')?>
<?php 
    if($_POST){
        $icono = (isset($_POST['txtIcono']))?$_POST['txtIcono']:"";
        $titulo = (isset($_POST['txtTitulo']))?$_POST['txtTitulo']:"";
        $descripcion = (isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";

        $sentencia = $conexion->prepare("INSERT INTO `tbl_servicios` (`id`, `icono`, `titulo`, `descripcion`)
        VALUES (NULL, :icono, :titulo, :descripcion)");

        $sentencia->bindParam(":icono",$icono);
        $sentencia->bindParam(":titulo",$titulo);
        $sentencia->bindParam(":descripcion",$descripcion);

        $sentencia->execute();
        $mensaje = "Registro creado";
        header("Location:index.php?mensaje=".$mensaje);
    }
?>

<?php include('../../../template/cabecera.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Servicios</div>
            <div class="card-body">
                <form action="crear.php" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Icono:</label>
                        <input type="text" class="form-control" name="txtIcono" aria-describedby="helpId" placeholder=""/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Titulo:</label>
                        <input type="text" class="form-control" name="txtTitulo" aria-describedby="helpId" placeholder=""/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripcion:</label>
                        <input type="text" class="form-control" name="txtDescripcion" aria-describedby="helpId" placeholder=""/>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
                </form>
            </div>
        </div>
        
    </div>
    



</body>
</html>