<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) { 
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
          $sql = $db->query("SELECT * FROM ".$db->escape($table)." WHERE id=".$db->escape($id)." LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
 
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
/* Function for Update data ESTATUS from table by id
/*--------------------------------------------------------------*/
function update_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "UPDATE ".$db->escape($table);
    $sql .= " SET ";
    $sql .= " estatus = not(estatus) ";
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
    $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
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
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
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
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  
    /*--------------------------------------------------------------*/
  /* Find all employees by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
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
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
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
            redirect('index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','Este nivel de usuario esta inactivo!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }
 

/*--------------------------------------------------------------*/
/* Function for Count id By table y validar si esta usado en otra relacion cascada
/*--------------------------------------------------------------*/

function count_by_id_relation($opcion,$id){
  global $db;

  if($opcion === 'group'){
        $sql = "SELECT COUNT(id) AS total FROM users WHERE user_level = (select group_level from user_groups where id = '{$db->escape($id)}')";       
  }  
  if($opcion === 'users'){
        $sql = "SELECT count(id) AS total FROM users WHERE id = '{$db->escape($id)}' and status = 1";        
  } 
   
  $result = $db->query($sql);
  return($db->fetch_assoc($result));  
}

  /*--------------------------------------------------------------*/
  /* Function registro de bitacora
  /*--------------------------------------------------------------*/
 function bitacora($user_id, $evento)
  {
    global $db;
    
    $sql = "INSERT INTO bitacora (id_user, evento) VALUES ";
    $sql .= "('{$user_id}', '{$evento}')";
    
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
  }


/*--------------------------------------------------------------*/
/* Grafica de movimientos a responsable
/*--------------------------------------------------------------*/
function find_all_bitacora($table){
    global $db;

    $results = array();

    $sql =  "SELECT a.id ";
    $sql .= ", b.name as id_user";
    $sql .= ", upper(a.evento) as evento ";
    $sql .= ", a.fechahora ";
    $sql .= "FROM bitacora a ";
    $sql .= ", users b ";
    $sql .= "WHERE b.id = a.id_user ";
    $sql .= "ORDER BY a.id DESC ";

    $result = find_by_sql($sql);
    return $result;
}


/*--------------------------------------------------------------*/
/* Function for find all datos repetidos
/*--------------------------------------------------------------*/

function find_by_clavegeneral($table, $val)
{
  global $db;
  $sql = "SELECT id FROM ".$table." WHERE id = '{$db->escape($val)}' LIMIT 1 ";
  $result = $db->query($sql);
  return($db->num_rows($result) === 0 ? true : false);
}

function find_by_nocasa($val)
{
  global $db;
  $sql = "SELECT id FROM residentes WHERE no_casa = '{$db->escape($val)}' LIMIT 1 ";
  $result = $db->query($sql);
  return($db->num_rows($result) === 0 ? true : false);
}


/*--------------------------------------------------------------*/
/* Function for find all database table residentes
/*--------------------------------------------------------------*/
function find_all_residentes() {
  global $db;

    $sql = "   SELECT  id
                      , no_casa numero_casa
                      , usuario
                      , telefono_usuario
                      , (select upper(descripcion) from tipo_residente where id = r.idtiporesidenteu ) as tipo_usuario                      
                      , vehiculo
                      , mascotas
                      , idestado
                      , cuota
                  FROM residentes r
            ORDER BY r.no_casa ";  
  
    return find_by_sql($sql);
}


/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/* and ESTATUS by valor
/*--------------------------------------------------------------*/
function find_all_estatus($table, $valor) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE estatus =".$db->escape($valor)." ORDER BY descripcion");
   }
}


function find_historico_pagos($id) {
  global $db;

    $sql  = "SELECT id ";
    $sql .= ", fecha_cobro ";
    $sql .= ", mes ";
    $sql .= ", anio ";
    $sql .= ", importe ";
    $sql .= ", pago ";
    $sql .= ", (SELECT descripcion FROM tipo_pagos WHERE id = m.idtipopago) tipo_pago ";
    $sql .= ", (SELECT descripcion FROM tipo_movimiento WHERE id = m.idtipomovimiento) tip_movimiento ";
    $sql .= ", usuario ";
    $sql .= "FROM mantenimientos m ";
    $sql .= "WHERE no_casa = (SELECT no_casa FROM residentes WHERE id = ". $db->escape($id).") ";
    $sql .= "AND estatus = 1 ";
    $sql .= "ORDER BY id DESC ";

    return find_by_sql($sql);
}

function find_residente_id($id)
{
  global $db;  
  
  $sql = "SELECT * FROM residentes WHERE id = '{$db->escape($id)}' ";   
  $result = $db->query($sql);
  
  if($db->num_rows($result) > 0){

      $sql =  "SELECT no_casa as no_casa ";
      $sql .= ", usuario as usuario ";
      $sql .= "FROM residentes ";
      $sql .= "WHERE id = '{$db->escape($id)}' ";      

  }
  else {
    $sql = "SELECT 0 as no_casa, '' as usuario FROM dual"; 
  }
  
  $result = $db->query($sql);
  return($db->fetch_assoc($result));  
}

function ultimo_pago($id)
{
  global $db;  
  
  $sql = "SELECT * FROM mantenimientos WHERE no_casa = (SELECT no_casa FROM residentes WHERE id = '{$db->escape($id)}' )";   
  $result = $db->query($sql);
  
  if($db->num_rows($result) > 0){

      $sql =  "SELECT pago as maximo FROM mantenimientos WHERE id = ( ";
      $sql .= "SELECT MAX(id) ";
      $sql .= "FROM mantenimientos ";
      $sql .= "WHERE no_casa = (SELECT no_casa FROM residentes WHERE id = '{$db->escape($id)}') ";
      $sql .= "AND estatus = 1)";

  }
  else {
    $sql = "SELECT 0 as maximo FROM dual"; 
  }
  
  $result = $db->query($sql);
  return($db->fetch_assoc($result));  
}


function indice_aportacion(){
  global $db;
  $results = array();

  $sql = "SELECT COUNT(r.id) viviendas
               , e.descripcion estado
            FROM residentes r
               , estados e
          WHERE e.id = r.idestado
          GROUP BY r.idestado";

  $result = find_by_sql($sql);
  return $result;
}

function ingresos_mensual(){
    global $db;
    $results = array();

    $sql = "SELECT SUM(pago) as importe
                 , COUNT(id) as pagos
                 , MAX(fecha_cobro) as fecha
              FROM mantenimientos m
             WHERE mes = MONTH(CURDATE())
               AND anio = YEAR(CURDATE())
               AND estatus = 1";

    $result = find_by_sql($sql);
    return $result;
}

function ingresos_tipo_mensual(){
    global $db;
    $results = array();

    $sql = "   SELECT SUM(p.monto) AS ingresos
                    , t.descripcion AS tipo
                 FROM pagos p
                    , tipo_pagos t
                WHERE YEAR(p.fecha) = YEAR(CURDATE())
                  AND MONTH(p.fecha) = MONTH(CURDATE())
                  AND p.id_estado = 1
                  AND p.descuento = 0
                  AND t.id = p.id_tipo_pago
             GROUP BY t.descripcion";

    $result = find_by_sql($sql);
    return $result;
}

function find_all_residentes_activos() {
  global $db;

    $sql =  "SELECT r.id as id , r.usuario as nombre ";
    $sql .= "FROM residentes r ";
    $sql .= "WHERE r.idestado = 1 ";
    $sql .= "ORDER BY r.usuario";    

    return find_by_sql($sql);
}


function find_no_casa_activa() {
   global $db;

     $sql =  "SELECT r.id as id ";
     $sql .= ", r.no_casa as descripcion ";
     $sql .= "FROM residentes r ";
     $sql .= "WHERE r.idestado = 1 ";
     $sql .= "ORDER BY r.no_casa ";

     return find_by_sql($sql);
}

function find_all_proveedores() {
  global $db;

    $sql =  "SELECT p.id ";
    $sql .= ", p.nombre ";
    $sql .= ", p.telefono ";
    $sql .= ", p.descripcion ";
    $sql .= ", s.descripcion as tiposervicio";
    $sql .= ", p.estatus ";
    $sql .= "FROM proveedores p ";
    $sql .= ", tipo_servicio s ";
    $sql .= "WHERE s.id = p.idtiposervicio ";
    $sql .= "ORDER BY p.id";

    return find_by_sql($sql);
}
?>
