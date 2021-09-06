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
          <button type="button" class="btn btn-info btn-min-width mr-1 mb-1" data-toggle="modal" data-target="#bootstrap" data-id="<?php echo $row['id'];?>">Editar</button>
        </td>
    </tr>
<?php } ?>