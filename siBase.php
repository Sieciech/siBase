<?php
$_SQL = array();
 ////  Definicje baz danych  V

$_SQL[0] = array( // MySQL
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'mysql',
  'host' => 'localhost',
  'user' => 'user',
  'password' => 'password',
  'database' => 'base',
  'prefix' => 'si_',
);
$_SQL[1] = array( // Firebird
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'firebird',
  'user' => 'user',
  'password' => 'password',
  'database' => 'T:\\Klimreg.GDB',
  'prefix' => 'si_',
);
$_SQL[2] = array( // ODBC
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'odbc',
  'user' => 'user',
  'password' => 'password',
  'database' => '/usr/local/dbconnect',
  'prefix' => 'si_',
);
$_SQL[3] = array( // SQLite
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'sqlite',
  'user' => 'user',
  'password' => 'password',
  'database' => '/var/db/example.db',
  'prefix' => 'si_',
);
$_SQL[4] = array( // IBM DB2
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'ibm',
  'user' => 'user',
  'password' => 'password',
  'database' => 'example',
  'host' => '127.0.0.1',
//  'protocol'=>'TCPIP',
  'port' => '5000',
  'prefix' => 'si_',
);
$_SQL[5] = array( // Informix
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'informix',
  'user' => 'user',
  'password' => 'password',
  'database' => 'example',
  'host' => '127.0.0.1',
//  'protocol'=>'onsoctcp',
  'prefix' => 'si_',
);
$_SQL[6] = array( // MS SQL Server
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'sqlsrv',
  'user' => 'user',
  'password' => 'password',
  'database' => 'example',
  'host' => '127.0.0.1',
//  'port'=>'1234',
  'prefix' => 'si_',
);
$_SQL[7] = array( // MS SQL, Sybase, dblib
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'mssql',// mssql, sybase, dblib
  'user' => 'user',
  'password' => 'password',
  'database' => 'example',
  'host' => '127.0.0.1',
  'prefix' => 'si_',
);
$_SQL[8] = array( // Oracle OCI
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'oci',
  'user' => 'user',
  'password' => 'password',
  'database' => 'example',
  'host' => '127.0.0.1',
  'port' => 1234,
  'prefix' => 'si_',
);
$_SQL[9] = array( // PostgreSQL
  'db' => array(),
  'charset'=>'UTF8',
  'debug' => true,
  'type' => 'pgsql',
  'user' => 'user',
  'password' => 'password',
  'database' => 'example',
  'host' => '127.0.0.1',
  'port' => 1234,
  'prefix' => 'si_',
);
 ////  Definicje baz danych  A

function sql_connect($n = 0)
{
  global $_SQL;
  try
  {
    if(!isset($_SQL[$n]['db']))
      $_SQL[$n]['db'] = array();
    $_SQL[$n]['db'] = array();
    switch(strtolower($_SQL[$n]['type']))
    {
      case 'mysql':
        $_SQL[$n]['db']['link'] = new PDO('mysql:host='.$_SQL[$n]['host'].';dbname='.$_SQL[$n]['database'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'firebird':
        $_SQL[$n]['db']['link'] = new PDO('firebird:dbname='.$_SQL[$n]['database'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'odbc':
        $_SQL[$n]['db']['link'] = new PDO('uri:file://'.$_SQL[$n]['database'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'sqlite':
        $_SQL[$n]['db']['link'] = new PDO('sqlite:'.$_SQL[$n]['database'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'ibm':
        $_SQL[$n]['db']['link'] = new PDO('ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE='.$_SQL[$n]['database'].';HOSTNAME='.$_SQL[$n]['host'].';PORT='.$_SQL[$n]['port'].';PROTOCOL='.(isset($_SQL[$n]['protocol'])?$_SQL[$n]['protocol']:'TPCIP').';', $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'informix':
        $_SQL[$n]['db']['link'] = PDO('informix:host='.$_SQL[$n]['host'].';service=9800;database='.$_SQL[$n]['database'].';server='.$_SQL[$n]['database'].'; protocol='.(isset($_SQL[$n]['protocol'])?$_SQL[$n]['protocol']:'onsoctcp').';EnableScrollableCursors=1', $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'sqlsrv':
        $_SQL[$n]['db']['link'] = PDO('sqlsrv:Server='.$_SQL[$n]['host'].(isset($_SQL[$n]['port'])?','.$_SQL[$n]['port']:'').';Database='.$_SQL[$n]['database'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'mssql':
      case 'sybase':
      case 'dblib':
        $_SQL[$n]['db']['link'] = PDO($_SQL[$n]['type'].':host='.$_SQL[$n]['host'].';dbname='.$_SQL[$n]['database'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'oci':
        $_SQL[$n]['db']['link'] = PDO('oci:dbname=//'.$_SQL[$n]['host'].':'.$_SQL[$n]['port'].'/'.$_SQL[$n]['database'].';charset='.$_SQL[$n]['charset'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;

      case 'pgsql':
        $_SQL[$n]['db']['link'] = PDO('pgsql:host='.$_SQL[$n]['host'].';port='.$_SQL[$n]['port'].';dbname='.$_SQL[$n]['database'], $_SQL[$n]['user'], $_SQL[$n]['password']);
      break;
      
      default:
        die('<div style="padding:20px;color:#000;background:#f88;">Typ bazy danych ('.$_SQL[$n]['type'].') nie jest wspierany / This type of database ('.$_SQL[$n]['type'].') is not supported!</div>');
      break;
    }
    if(isset($_SQL[$n]['debug']) and $_SQL[$n]['debug'])
      $_SQL[$n]['db']['link']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $_SQL[$n]['db']['connect'] = true;
  }
  catch(PDOException $e)
  {
    exit('Połączenie z bazą danych `'.$n.'` jest teraz nie możliwe.');
  }
}
function sql($sql, $table = false, $inputs = array(), $retrow = false, $n = 0)
{
  global $_SQL, $_SQL;
  if($sql[0] == ':')
  {
    $word = explode(' ', $sql);
    if($word[0] == ':GET')
    {
      if($word[1] == '_SQL')
      return $_SQL[$n][$word[2]];
    }
  }
  if(!isset($_SQL[$n]['db']['connect']))
  {
    sql_connect($n);
  }
  if(!is_array($inputs) && $inputs == true)
  {
    $inputs = array();
    $retrow = true;
  }
  if(is_array($table))
  {
    foreach($table as $k => $w)
    {
      $j = $k+1;
      $inputs['_table'.$j] = $w[0] == '_' ? substr($w, 1) : $_SQL[$n]['prefix'].$w ;
    }
  }
  else
  $inputs['_table'] = $table[0] == '_' ? substr($table, 1) : $_SQL[$n]['prefix'].$table ;
  foreach($inputs as $name => $value)
  {
    if($name[0] == '_')
    {
      unset($inputs[$name]);
      $name = substr($name, 1);
      $sql = str_replace(':'.$name.' ', '`'.$value.'` ', $sql);
      $sql = str_replace(':'.$name.'.', '`'.$value.'`.', $sql);
    }
    elseif($name[0] == '-')
    {
      unset($inputs[$name]);
      $name = substr($name, 1);
      $sql = str_replace(':'.$name, $value, $sql);
    }
  }

  $query = $_SQL[$n]['db']['link']->prepare($sql);
  $types = array(
    'id' => 'int',
  );
  foreach($inputs as $name => $value)
  {
    if(strpos($sql, ':'.$name) !== false)
    {
      $type = (isset($types[$name]))?$types[$name]:'str';
      switch($type)
      {
        case 'int':
          $query->bindValue(':'.$name, $value, PDO::PARAM_INT);
         break;

        default:
        case 'str':
          $query->bindValue(':'.$name, $value, PDO::PARAM_STR);
         break;
      }
    }
  }
  $type = explode(' ', $sql);
  $type0 = strtoupper($type[0]);
  $type1 = strtoupper($type[1]);
  switch($type0)
  {
    case 'SELECT':
      $query->execute();
      $count = substr($type1, 0, 5) == 'COUNT' ? true:false;
      $group = strpos($sql, ' GROUP BY ') === false ? false:true;
      $retrow_last = $retrow;
      if($count && !$group) $retrow = true;
      if($retrow)
      {
        return removeslash($query->fetch(PDO::FETCH_ASSOC));
      }
      else
      {
        return removeslash($query->fetchAll(PDO::FETCH_ASSOC));
      }
      return $ret;
     break;

    case 'INSERT':
      if($retrow === false) return $query->execute();
      $query->execute();
      return $_SQL[$n]['db']['link']->lastInsertId($retrow===true?'id':$retrow);
     break;


    default:
    case 'DELETE':
    case 'UPDATE':
      return $query->execute();
     break;
  }
  return false;
}
function removeslash($a)
{
  if(is_array($a))
  {
    foreach($a as $b => $c)
    {
      $a[$b] = removeslash($c);
    }
    return $a;
  }
  else
  {
    return stripslashes($a);
  }
}
?>
