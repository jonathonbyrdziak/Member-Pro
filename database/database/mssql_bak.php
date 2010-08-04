<?php

/**********************************************************************
 *
 * Sample Custom Database Connection Script for a MSSQL database
 * using ADODB:odbc
 *
 **********************************************************************/


// No direct access
defined( '_EXEC' ) or die( 'Restricted access' );


class eDatabasemssql extends eDatabase 
{

	function __construct( $options )
	{
		$host		= array_key_exists('host', $options)	? $options['host']		: 'localhost';
		$user		= array_key_exists('user', $options)	? $options['user']		: '';
		$password	= array_key_exists('password',$options)	? $options['password']	: '';
		$database	= array_key_exists('database',$options)	? $options['database']	: '';
		$prefix		= array_key_exists('prefix', $options)	? $options['prefix']	: 'jos_';
		$select		= array_key_exists('select', $options)	? $options['select']	: true;
		
		// perform a number of fatality checks, then return gracefully
		if (!function_exists( 'mssql_connect' )) {
			$this->_errorNum = 1;
			$this->_errorMsg = 'The MsSQL adapter "mssql" is not available.';
			return;
		}

		// connect to the server
		if (!($this->_resource = @mssql_connect( $host, $user, $password, true ))) {
			$this->_errorNum = 2;
			$this->_errorMsg = 'Could not connect to MsSQL';
			return;
		}

		// finalize initialization
		parent::__construct($options);

		// select the database
		if ( $select ) {
			$this->select($database);
		}
	}



	/**
	 * Determines if the connection to the server is active.
	 *
	 * @access	public
	 * @return	boolean
	 * @since	1.5
	 */
	function connected()
	{
		if(is_resource($this->_resource)) {
			return mysql_ping($this->_resource);
		}
		return false;
	}

	
	
	
	/*************************************************************
	*
	*  connect()
	*
	*     Returns:
	* 	  - Database Connection Object if successful
	*         - NULL if unsuccessful
	*
	**************************************************************/
	function connect($hostname, $database, $username, $password, $test=0) {
	
		// Include the ADODB drivers. May or may not be needed depending on
		// how your PHP has been setup. You will likely need to edit the path
		// to the include files.
		
		//include_once ('adodb5/adodb.inc.php');
		//include_once ('adodb5/adodb-active-record.inc.php');
		
   		$db =& ADONewConnection('odbc_mssql');
			$dsn = "Driver={SQL Server};Server=" . $hostname . ";" . "Database=" . $database . ";";
			$db->Connect( $dsn,$username, $password ) or die ( "Failed to connect to database" );
			
		// Force UTF8
		$db->charPage = CP_UTF8;
		//$db->charPage = iso8859-1;

				
		return $db;
	}
	
	

	/*************************************************************
	*
	* query()
	*
	* 	Returns an array with result objects if successful
	*
	*         Expeccted array format is shown below.
	*
	*		SELECT id, title FROM jos_content LIMIT 0,2
	*
	*
	*		Array
	*		(
    	*			[0] => stdClass Object
	*				(
	*				    [id] => 1
	*				    [title] => Welcome to Joomla!
	*				)
	*
	*			[1] => stdClass Object
	*				(
	*				    [id] => 2
	*				    [title] => Newsflash 1
	*				)
	*		)
        *
	*
	*
	*
	*
	*      Return Error Message (as a string) if unsuccessful
	**************************************************************/
	function query($db, $query,$returnResults=1) {

		// Include the ADODB drivers. May or may not be needed depending on
		// how your PHP has been setup. You will likely need to edit the path
		// to the include files.
		
		//include_once ('adodb5/adodb.inc.php');
		//include_once ('adodb5/adodb-active-record.inc.php');

		if ( $db ) {			
			$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
			$retArr = array();
			$i=0;
			if ( $returnResults ) {			
				$recordSet = $db->Execute($query);				
				if ($recordSet) {
					while ($o = $recordSet->FetchNextObject(false)) {
						$retArr[$i]=$o;
						$i++;
         				}         				
					if ( $i > 0 ) {
						 return $retArr;
					} else {
						 return '';
					}
					
				} else {
					return $db->ErrorMsg();
				}								
			
			} else {			
				// No returned results (Update query from Scheduler etc)				
				$ret = $db->query();
				if ( $ret ) {
					return true;
				} else {
					return $db->getErrorMsg();
				}			
			}			
		} else {
			return false;
		}
	}

	/*************************************************************
	*
	* test()
	*
	*   Optional Query Test Function
	*
	*
	**************************************************************/
	function test($db) {
		
		$ret = false;		
		if ( $db ) {
			
			$query="SELECT * from sometable";   // Update this!
			
			$rows = sql2excel_customDB::query($db, $query);
			// Check if any rows were returned 
			
			return $rows;
		}
	}
	
}

?>