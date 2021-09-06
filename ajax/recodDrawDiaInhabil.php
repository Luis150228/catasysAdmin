<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
// $t = ('U');
$a = ($_POST['buscar']);

$sql ="CALL showDiasInhabiles('$a')";

$result=mysqli_query($conn,$sql);

while ($row = mysqli_fetch_array($result)) {?>
    <tr>
      <td><?php echo $row['decripcion'];?></td>
      <td><?php echo $row['inicio'];?></td>
      <td><?php echo $row['fin'];?></td>
      <td><?php echo $row['awo'];?></td>
      <td>
          <a title="Editar" class="btn btn-icon btn-info mr-1 mb-1" href="./editarDias.php?id=<?php echo $row['id'];?>"><i class="la la-edit"></i></a></a>
        </td>
    </tr>
<?php } ?>