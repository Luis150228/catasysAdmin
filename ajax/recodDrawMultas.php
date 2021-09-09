<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
// $t = ('U');
$a = ($_POST['buscar']);

$sql ="CALL showRecargo('$a')";

$result=mysqli_query($conn,$sql);

while ($row = mysqli_fetch_array($result)) {?>
    <tr>
      <td><?php echo $row['rango_dias'];?></td>
      <td><?php echo $row['multas'];?></td>
      <td><?php echo $row['recargos'];?></td>
      <td>
          <a title="Editar" class="btn btn-icon btn-info mr-1 mb-1" href="./editarMultasRecargos.php?id=<?php echo $row['id'];?>"><i class="la la-edit"></i></a></a>
        </td>
    </tr>
<?php } ?>