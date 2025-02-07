<?php include('../../../conexion.php')?>
<?php include('../../../template/cabecera.php')?>
<?php 
   if(isset($_GET['txtId'])){
        $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_configuraciones` WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();

        $sentencia = $conexion->prepare("DELETE FROM tbl_configuraciones WHERE id=:id");
        $sentencia->bindParam(':id',$_GET['txtId']);
        $sentencia->execute();
   }

    $sentencia = $conexion->query("SELECT * FROM tbl_configuraciones");
    $sentencia->execute();
    $listaConfiguraciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Configuraciones</h1>
<div class="container">
    <div class="card">
        <div class="card-header">
            <!--
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a> 
            -->
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre de la configuracion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaConfiguraciones as $registros){?>
                        <tr class="">
                            <td><?php echo $registros['id']?></td>
                            <td><?php echo $registros['nombre']?></td>
                            <td><?php echo $registros['valor']?></td>
                            <td>
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-info"
                                    href="editar.php?txtId=<?php echo $registros['id']; ?>"
                                    role="button"
                                    >Editar
                                </a>
                                <!--
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-danger"
                                    href="index.php?txtId=<?php echo $registros['id']; ?> "
                                    role="button"
                                    >Eliminar</a
                                >
                                -->
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>           
        </div>
    </div>
</div>


