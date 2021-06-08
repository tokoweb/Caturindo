<?php
//require 'app/lib/vendor/api/autoload.php';

class DBConnection {

    protected $connParams;

    /**
     * @var \Doctrine\DBAL\Connection
     */
    static public $conn=false;

    public function __construct()
    {
            // $this->connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);     //koneksi dengan mysql connect
            // $this->connect_pdo(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);     //koneksi dengan library PDO

            //koneksi dengan library Doctrine
            if (DB_DRIVER == 'pdo_pgsql') {

            }else if(DB_DRIVER == 'pdo_mysql'){
                    $this->connect_doctrine_mysql(DB_NAME,DB_USER,DB_PASSWORD,DB_HOST,DB_DRIVER);
            }else if(DB_DRIVER == 'oci8'){
                    $this->connect_doctrine_oci8(DB_NAME,DB_USER,DB_PASSWORD,DB_HOST,DB_DRIVER,DB_PORT);
            }else{
            die("
            <center>
                    <div style='border: 1px solid #f69191; background: #fdd1d1; font: 11px Tahoma,Arial,Verdana lighter; font-weight: bold; color: #ad6060; width: 400px; padding: 20px; margin: 100px auto'>
                    TYPE CONNECTION NOT DETECTED </font></div>
            </center>");
            }

    }

  /**
   *
   * @param type $address
   * @param type $account
   * @param type $pwd
   * @param type $name
   * @return int
   */
  function connect($address, $account, $pwd, $name) {
       $this->_dbHandle = @mysql_connect($address, $account, $pwd);
       if ($this->_dbHandle != 0) {
           if (mysql_select_db($name, $this->_dbHandle)) {
               return 1;
           }
           else {
               return 0;
           }
       }
       else {
           return 0;
       }
   }

   function connect_pdo($address, $account, $pwd, $name) {
        try {
            DBConnection::$conn = new PDO("mysql:host=$address;dbname=$name", $account, $pwd,array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,));
            DBConnection::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $conn){
            die("<center>
                    <div style='border: 1px solid #f69191; background: #fdd1d1; font: 11px Tahoma,Arial,Verdana lighter; font-weight: bold; color: #ad6060; width: 400px; padding: 20px; margin: 100px auto'>
                    <br><font color=#931b1b> '".$conn->getMessage()."' </font></div>
		</center>");
	}
   }

    // koneksi doctrine oci8
    function connect_doctrine_oci8($name,$account, $pwd,$address,$driver,$port){
        $this->connParams = array(
            'dbname'    => $name,
            'user'      => $account,
            'password'  => $pwd,
            'host'      => $address,
            'driver'    => $driver,
            'port'	=> $port,
            'wrapperClass' => 'Doctrine\DBAL\Portability\Connection',
            'portability' => \Doctrine\DBAL\Portability\Connection::PORTABILITY_ALL
	);
        $config = new \Doctrine\DBAL\Configuration();
        $evm = new \Doctrine\Common\EventManager();
        $evm->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\OracleSessionInit());
        DBConnection::$conn = \Doctrine\DBAL\DriverManager::getConnection($this->connParams,$config,$evm);
    }

    // koneksi doctrine mysql
    function connect_doctrine_mysql($name,$account, $pwd,$address,$driver){
        $this->connParams = array(
            'dbname'    => $name,
            'user'      => $account,
            'password'  => $pwd,
            'host'      => $address,
            'driver'    => $driver,

	);
        DBConnection::$conn = \Doctrine\DBAL\DriverManager::getConnection($this->connParams);
	}
    static public function getRecordWithPagin($query,$awal,$akhir=NULL){
        $batas = (($akhir!=NULL)?$akhir:PAGINATE_LIMIT);
        if (DB_DRIVER == 'pdo_pgsql') {
            $sql=DBConnection::$conn->prepare($query." LIMIT :batas
            OFFSET :awal  ");
            $sql->bindParam(':awal', $awal, PDO::PARAM_INT);
            $sql->bindParam(':batas', $batas, PDO::PARAM_INT);
            $sql->execute();
	}else if(DB_DRIVER == 'pdo_mysql'){
            $sql=  DBConnection::$conn->prepare($query." LIMIT :awal, :batas  ");
            $sql->bindParam(':awal', $awal, PDO::PARAM_INT);
            $sql->bindParam(':batas', $batas, PDO::PARAM_INT);
            $sql->execute();
	}else if(DB_DRIVER == 'pdo_oci' || DB_DRIVER == 'oci8'){
            $sql = DBConnection::$conn->prepare("SELECT * FROM
            (SELECT K.*, ROWNUM rnum FROM
            (".$query.") K
            WHERE ROWNUM <= :batas)
            WHERE rnum > :awal"); //ROWNUM=jml_tampil, rnum=awal
            $bound = $batas + $awal;
            $sql->bindParam(':awal', $awal, PDO::PARAM_INT);
            $sql->bindParam(':batas', $bound, PDO::PARAM_INT);
            $sql->execute();
	}else{
             die("<center>
                    <div class='alert'>
                   ERROR : <font color=#931b1b> belum ada fungsi pagin untuk driver RDBMS ".DB_DRIVER."</font></div>
		</center>"
            );
	}
        return $sql;
    }

    static public function getRowCount($query){
	$sql = DBConnection::$conn->prepare($query);
	$sql->execute();
	$jumlah_data = count($sql->fetchAll(PDO::FETCH_BOTH));
	return $jumlah_data;
    }

    function __destruct()
    {

    }


}
?>
