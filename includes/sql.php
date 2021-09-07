<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/catasysAdmin/access.php'); ///Conecion General Al ROOT
include (INCLUDE_PATH.'load.php');///Cargar Datos
/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {//'marc_switch'
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}

/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
// function find_by_folio($table,$folios)
// {
//   global $db;
//   $folios = $folio;
//     if(tableExists($table)){
//           $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE `folio`='{$db->escape($folio)}'");
//           if($result = $db->fetch_assoc($sql))
//             return $result;
//           else
//             return null;
//      }
// }

/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level FROM t_users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM t_users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('t_users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level WHERE 1 ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
  {
    global $db;
    $date = make_date();
    $sql = "UPDATE t_users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
  }

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('../index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','Este nivel de usaurio esta inactivo!');
           redirect('../home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('../home.php', false);
        endif;

     }


/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id2($table,$columna1,$columna2,$id,$identificador2)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($columna1)}='{$db->escape($id)}' AND {$db->escape($columna2)}='{$db->escape($identificador2)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id3($table,$columna1,$columna2,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($columna1)}='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id 2
/*--------------------------------------------------------------*/
function delete_by_id2($table,$columnabusqueda,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql  = "DELETE FROM {$db->escape($table)} WHERE {$db->escape($table)}.{$db->escape($columnabusqueda)} = {$db->escape($id)}";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  
   }
}


/*--------------------------------------------------------------*/
/* Mostrar listado de traslados de Dominio
/*--------------------------------------------------------------*/
function mostrarTraslados(){
  global $db;  
  $sql  ="SELECT folio, adquiriente, enajenante, tipop, num_escr, f_escr, f_act, dias_tr, rango_dias, superficie, tipomov, cta_o, cta_ap, prcDivision, prcFracc, v_operac, v_fisc, v_peric, tipo_uma, imp_r_uma, UPPER(n.identificador) as notario, usr_genera, c.firma_digital as firmCreador, f_genera, usr_autoriza, a.firma_digital as firmAutoriza, f_autoriza, usr_mod, status_traslado, f_mod, efecto, c_catas, b_imp_td, imp_cert_na, form_atd, imp_td, imp_hons, impue_div, impue_fracc, imp_recar, imp_multa, imp_total, c.name as elaboro, a.name as autorizo, prctasa_td, prcrecargos, IF(cancelado = 'A', 'la la-pause', IF(cancelado = 'P', 'la la-pause', IF(cancelado = 'O', 'la la-angle-double-up', 'la la-angle-double-down'))) as class FROM (SELECT folio, adquiriente, enajenante, IF(tipop = 'U', 'URBANO', 'RUSTICO') tipop, num_escr, f_escr, f_act, dias_tr, rango_dias, area as superficie, tipomov, cta_o, cta_ap, CONCAT(ROUND(((tipovnt)*100),2), '%') prcDivision, CONCAT(ROUND(((imp_fracc)*100),2), '%') prcFracc, honorarios_recibo, honorarios_imp, v_operac, v_fisc, v_peric, tipo_uma, imp_r_uma, CONCAT(ROUND(((tasa_td)*100),2), '%') prctasa_td, tasa_hon, notari, usr_genera, f_genera, usr_autoriza, f_autoriza, usr_mod, status_traslado, f_mod, efecto, c_catas, b_imp_td, imp_cert_na, form_atd, imp_td, imp_hons, convert(impue_div, NCHAR) impue_div, impue_fracc, imp_recar, imp_multa, imp_total, CONCAT(ROUND(((prc_recargos)*100),2), '%') prcrecargos, cancelado FROM t_traslados WHERE 1 ORDER BY folio DESC)t LEFT JOIN t_users c
  ON t.usr_genera = c.username
  LEFT JOIN t_users a
  ON t.usr_autoriza = a.username
  LEFT JOIN t_notarios n
  ON t.notari = n.idt_notarios";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Mostrar listado de Valores
/*--------------------------------------------------------------*/
function mostrarValores(){
  global $db;  
  $sql  ="SELECT id, descripcion, valor, tipo, sust_legal, usr_actualiza, f_actualiza FROM t_valores WHERE valor > 0";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Mostrar listado de Multas y Recargos
/*--------------------------------------------------------------*/
function mostrarMuRe(){
  global $db;  
  $sql  ="SELECT id, rango_dias, multas, recargos, usr_mod, f_modifica FROM t_multas_recargos";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Funcion Mostrar UMA anual correspondiente a reduccion
/*--------------------------------------------------------------*/
function umas(){
  global $db;  
  $sql  ="SELECT opcion, descripcion, (opcion * v.valor) as reduccion, v.valor as valorBaseAnual FROM t_uma INNER JOIN (SELECT valor FROM t_valores WHERE tipo = 'uma')v";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Funcion Mostrar listado de valores
/*--------------------------------------------------------------*/
function dataValoresLista($tipo){
  global $db;  
  $sql  ="SELECT descripcion, valor, tipo FROM t_valores where tipo = '{$tipo}'";
  return find_by_sql($sql);
}


/*--------------------------------------------------------------*/
/* Funcion para mostrar un elemento de los vallores
/*--------------------------------------------------------------*/
function dataValores($tipo, $descrip){
  global $db;
          $sql = $db->query("SELECT descripcion, valor, tipo FROM t_valores where tipo = '{$tipo}' AND descripcion LIKE '%{$descrip}%'");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
}

/*--------------------------------------------------------------*/
/* Funcion para mostrar un elemento de los vallores
/*--------------------------------------------------------------*/
function multas_recargos(){
  global $db;
          $sql = $db->query("call multas_recargos('2021-06-15', '2021-08-26')");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
}
/*--------------------------------------------------------------*/
/* Funcion para mostrar caratula para edicion de traslados
/*--------------------------------------------------------------*/
function folioModal($id){
  global $db;
          $sql = $db->query("SELECT folio, adquiriente, enajenante, tipop, num_escr, f_escr, f_act, dias_tr, t.area, tipomov, cta_o, cta_ap, tipovnt, imp_fracc, honorarios_recibo, honorarios_imp, v_operac, v_fisc, v_peric, tipo_uma, imp_r_uma, imp_cert_na, form_atd, tasa_td, tasa_hon, notari, n.identificador AS notario, obs_pre, obs_end, usr_genera, f_genera, usr_autoriza, f_autoriza, usr_mod, cancelado, status_traslado, f_mod, efecto, c_catas, b_imp_td, imp_td, imp_hons, impue_div, impue_fracc, imp_recar, imp_multa, imp_total FROM (SELECT folio, adquiriente, enajenante, tipop, num_escr, f_escr, f_act, dias_tr, area, tipomov, cta_o, cta_ap, tipovnt, imp_fracc, honorarios_recibo, honorarios_imp, v_operac, v_fisc, v_peric, tipo_uma, imp_r_uma, imp_cert_na, form_atd, tasa_td, tasa_hon, notari, obs_pre, obs_end, usr_genera, f_genera, usr_autoriza, f_autoriza, usr_mod, cancelado, status_traslado, f_mod, efecto, c_catas, b_imp_td, imp_td, imp_hons, impue_div, impue_fracc, imp_recar, imp_multa, imp_total FROM t_traslados WHERE folio = '{$id}')t
          LEFT JOIN t_users c
          ON t.usr_genera = c.username
          LEFT JOIN t_users a
          ON t.usr_autoriza = a.username
          LEFT JOIN t_notarios n
          ON t.notari = n.idt_notarios");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
}

/*--------------------------------------------------------------*/
/* Funcion Mostrar listado de valores
/*--------------------------------------------------------------*/
function mostrarDias($id){
  global $db;
          $sql = $db->query("SELECT fecha_text as descripcion, fecha_inicio, fecha_fin, anhio FROM t_diasInhabiles where idt_diasInhabiles = '{$id}'");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
}

/*--------------------------------------------------------------*/
/* Funcion Mostrar listado de valores
/*--------------------------------------------------------------*/
function mostrarValor($id){
  global $db;
          $sql = $db->query("SELECT descripcion, valor, tipo, sust_legal FROM t_valores where id = '{$id}'");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
}


  ?>

