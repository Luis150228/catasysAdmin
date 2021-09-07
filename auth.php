<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conexion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
?>
<?php
$req_fields = array('user-name','user-password' );
validate_fields($req_fields);
$username = remove_junk($_POST['user-name']);
$password = remove_junk($_POST['user-password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    //create session with id
     $session->login($user_id);
    //Update Sign in time
     updateLastLogIn($user_id);
     $session->msg("s", "Bienvenido a administrativo CATOVATECH.");
     redirect('home.php',false);

  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('home.php',false);
}

?>