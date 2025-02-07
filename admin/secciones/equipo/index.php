<?php include('../../../template/cabecera.php')?>
<?php include('../../../conexion.php')?>
<?php
   if(isset($_GET['txtId'])){
        $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_equipo` WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();

        $sentencia = $conexion->prepare("DELETE FROM tbl_equipo WHERE id=:id");
        $sentencia->bindParam(':id',$_GET['txtId']);
        $sentencia->execute();
   }

    $sentencia = $conexion->query("SELECT * FROM tbl_equipo");
    $sentencia->execute();
    $listaServicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Equipo</h1>
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
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Rol</th>
                            <!--
                            <th scope="col">X</th>
                            <th scope="col">Facebook</th> 
                            <th scope="col">Linkedin</th>  
                            --> 
                            <th scope="col">Redes</th> 
                            <th scope="col">Acciones</th>                
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaServicios as $registros){?>
                        <tr class="">
                            <td><?php echo $registros['id'];?></td>
                            <td><img width="50" src="../../../assets/img/team/<?php echo $registros['imagen'];?>" alt=""></td>
                            <td><?php echo $registros['nombre'];?></td>
                            <td><?php echo $registros['rol'];?></td>
                            <td>
                                <?php echo $registros['x'];?>
                                <br>
                                <?php echo $registros['facebook'];?>
                                <br>
                                <?php echo $registros['linkedin'];?>
                            </td>
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