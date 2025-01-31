<?php include('../../../template/cabecera.php')?>
<?php include('../../../conexion.php')?>
<?php 
   if(isset($_GET['txtId'])){
        $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";

        $sentencia = $conexion->prepare("SELECT `imagen` FROM `tbl_portafolio` WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $registroImagen = $sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registroImagen['imagen'])){
            if(file_exists("../../../assets/img/portfolio/".$registroImagen['imagen'])){
                unlink("../../../assets/img/portfolio/".$registroImagen['imagen']);
            }
        }

        $sentencia = $conexion->prepare("DELETE FROM `tbl_portafolio` WHERE id=:id");
        $sentencia->bindParam(':id',$_GET['txtId']);
        $sentencia->execute();
   }

    $sentencia = $conexion->query("SELECT * FROM `tbl_portafolio`");
    $sentencia->execute();
    $listaPortafolio = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Portafolio</h1>
    <div class="container">
    <div class="card">
    <div class="card-header">
       <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>      
    </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Subtitulo</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">URL</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaPortafolio as $registros){?>
                        <tr class="">
                            <td><?php echo $registros['id'];?></td>
                            <td><?php echo $registros['titulo'];?></td>
                            <td><?php echo $registros['subtitulo'];?></td>
                            <td><?php echo $registros['imagen'];?></td>
                            <td><?php echo $registros['descripcion'];?></td>
                            <td><?php echo $registros['cliente'];?></td>
                            <td><?php echo $registros['categoria'];?></td>
                            <td><?php echo $registros['url'];?></td>
                            <td>
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-info"
                                    href="editar.php?txtId=<?php echo $registros['id']; ?>"
                                    role="button"
                                    >Editar</a
                                >
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-danger"
                                    href="index.php?txtId=<?php echo $registros['id']; ?> "
                                    role="button"
                                    >Eliminar</a
                                >
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
        </div> 
    </div>
    
  
</body>
</html>

<?php include('../../../template/pie.php')?>