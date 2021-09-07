<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
// $t = ('U');
$a = ($_POST['buscar']);

$sql ="CALL showValores('$a')";

$result=mysqli_query($conn,$sql);

while ($row = mysqli_fetch_array($result)) {?>
    <tr>
      <td><?php echo $row['descripcion'];?></td>
      <td><?php echo $row['valor'];?></td>
      <td><?php echo $row['tipo'];?></td>
      <td><?php echo $row['sust_legal'];?></td>
      <td>
          <a title="Editar" class="btn btn-icon btn-info mr-1 mb-1" href="./editarValores.php?id=<?php echo $row['id'];?>"><i class="la la-edit"></i></a></a>
        </td>
    </tr>
<?php } ?>