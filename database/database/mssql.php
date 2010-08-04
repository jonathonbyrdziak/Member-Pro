<?php
/**
* @version		$Id: mssql.php 7074 2007-03-31 15:37:23Z jinx $
* @package		Joomla.Framework
* @subpackage	Database
* @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is within the rest of the framework
defined('_EXEC') or die();

/**
 * MSSQL database driver
 *
 * @package		Joomla.Framework
 * @subpackage	Database
 * @since		1.0
 */
if (!class_exists('bDatabaseMSSQL')){ class bDatabaseMSSQL extends bDatabase
{
	/** @var string The database driver name */
	var $name			= 'mssql';
	/** @var string The null/zero date string */
	var $_nullDate		= '0000-00-00 00:00:00';
	/** @var string Quote for named objects */
	var $_nameQuote		= '`';
	/** @var string Quote for named objects */
	var $connected		= false;
	
	/**
	* Database object constructor
	* @param string Database host
	* @param string Database user name
	* @param string Database user password
	* @param string Database name
	* @param string Common prefix for all tables
	*/
	function __construct( $options )
	{
		//var_dump_pre($options);
		$host		= array_key_exists('host', $options)	? $options['host']		: 'localhost';
		$user		= array_key_exists('user', $options)	? $options['user']		: '';
		$password	= array_key_exists('password',$options)	? $options['password']	: '';
		$database	= array_key_exists('database',$options)	? $options['database']	: '';
		$prefix		= array_key_exists('prefix', $options)	? $options['prefix']	: 'jos_';
		$select		= array_key_exists('select', $options)	? $options['select']	: true;	
		
		// perform a number of fatality checks, then return gracefully
		if (!function_exists( 'mssql_connect' )) {
			$this->_errorNum = 1;
			$this->_errorMsg = 'The MSSQL adapter "mssql" is not available.';
			return;
		}
		
		
		// connect to the server
		if (!($this->_resource = @mssql_connect( $host, $user, $password, true ))) {
			$this->_errorNum = 2;
			$this->_errorMsg = 'Could not connect to MSSQL: '.mssql_get_last_message();
			print_r($this->_resource);
			return;
		} else {
			$this->connected = true;
		}
		
		// finalize initializations
		parent::__construct($options);
		
		// select the database
		if ( $select )
		{
			$this->select('['.$database.']');
		}
	}

	/**
	 * Database object destructor
	 *
	 * @return boolean
	 * @since 1.5
	 */
	function __destruct()
	{
		$return = false;
		if (is_resource($this->_resource)) {
			$return = mssql_close($this->_resource);
			$this->connected = false;
		}
		return $return;
	}

	/**
	 * Test to see if the MSSQL connector is available
	 *
	 * @static
	 * @access public
	 * @return boolean  True on success, false otherwise.
	 */
	function test()
	{
		return (function_exists( 'mssql_connect' ));
	}

	/**
	 * Determines UTF support
	 */
	function hasUTF()
	{
		$verParts = explode( '.', $this->getVersion() );
		return ($verParts[0] == 5 || ($verParts[0] == 4 && $verParts[1] == 1 && (int)$verParts[2] >= 2));
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
		return $this->connected;
	}

  /**
	 * Select a database for use
	 *
	 * @access	public
	 * @param	string $database
	 * @return	boolean True if the database has been successfully selected
	 * @since	1.5
	 */
	function select($database)
	{
		if ( !$database )
		{
			$this->connected = false;
			return false;
		}
		
		if ( !mssql_select_db( $database, $this->_resource )) {
			$this->_errorNum = 3;
			$this->_errorMsg = 'Could not connect to database';
			$this->connected = false;
			return false;
		}

		// if running mssql 5, set sql-mode to mssql40 - thereby circumventing strict mode problems
		if ( strpos( $this->getVersion(), '5' ) === 0 ) {
			$this->connected = true;
			$this->setQuery( "SET sql_mode = 'MSSQL40'" );
			$this->query();
		}

		return true;
	}

	/**
	`	 * Custom settings for UTF support
	 */
	function setUTF()
	{
		//mssql_query("SET CHARACTER SET utf8",$this->_resource);
		mssql_query( "SET NAMES 'utf8'", $this->_resource );
	}

	/**
	* Get a database escaped string
	* @return string
	*/
	function getEscaped( $text )
	{
		// **** this will not work. need to double-up quotes etc to escape in mssql
//		echo 'escaping : '.$text.'<br />';
		return $text;
	}

	/**
	* Translate and execute the query
	* NB will not handle multiple queries if offset and limit is set
	* @return mixed A database resource if successful, FALSE if not.
	*/
	function query()
	{
		if (!is_resource($this->_resource)) {
			return false;
		}
		
		if ($this->_limit > 0 || $this->_offset > 0) {
			//$this->_sql .= ' LIMIT '.$this->_offset.', '.$this->_limit;		
			if (substr($this->_sql, 0, 6) == 'SELECT') {
				$sql_parts = preg_split('~((?<=SELECT DISTINCT)\\s)|((?<=SELECT(?! DISTINCT))\\s)~', $this->_sql);
				//var_dump_pre($sql_parts);
				
				// if we have a limit then insert appropriate "TOP" keywords to accomplish our desired result
				if (($this->_limit > 0) && ($this->_offset == 0)) {
					$this->_sql = $sql_parts[0].' TOP '.$this->_limit.' '.$sql_parts[1];
				}
				elseif (($order = stristr($this->_sql, 'ORDER BY')) !== false) {
					// compensate for MSSQL's awful omission of the LIMIT clause with an offset and limit defined
					$matches = array();
					preg_match('~(?<=ORDER BY).+(?=$|;|GROUP BY|HAVING)~U', $this->_sql, $matches);
					$orderClause = reset($matches);
					$orderParts = explode(',', $orderClause);
					foreach ($orderParts as $k=>$v) {
						$v2 = preg_replace(array('~(?<=\\s)ASC(?=\\W|$)~i', '~(?<=\\s)DESC(?=\\W|$)~i', '~\*\*\*~'), array('***', 'ASC', 'DESC'), $v);
						if ($v == $v2) {
							$v2 .= ' DESC';
						}
						$orderParts[$k] = $v2;
					}
					$orderClauseInv = implode(',', $orderParts);
					$this->_sql = 'SELECT * FROM ('
						."\n".' SELECT TOP '.$this->_limit.' * FROM ('
						."\n".' '.$sql_parts[0].' TOP '.($this->_offset + $this->_limit).' '.$sql_parts[1]
						."\n".' ) as newtbl ORDER BY'.$orderClauseInv
						."\n".' ) as newtbl2 ORDER BY'.$orderClause;
				}
			
			}
		}
		//echo '<b>MSSQL statement</b>: '.$this->_sql.'<br />';
		
		if ($this->_debug) {
			$this->_ticker++;
			$this->_log[] = $this->_sql;
		}
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		$this->_cursor = mssql_query( $this->_sql, $this->_resource );

		if (!$this->_cursor)
		{
			$this->_errorNum = mssql_errno( $this->_resource );
			$this->_errorMsg = mssql_error( $this->_resource )." SQL=$this->_sql";

			if ($this->_debug) {
				trigger_error('joomla.database:'.$this->_errorNum. ' bDatabaseMSSQL::query: '.$this->_errorMsg );
			}
			return false;
		}
		return $this->_cursor;
	}

	/**
	 * @return int The number of affected rows in the previous operation
	 * @since 1.0.5
	 */
	function getAffectedRows()
	{
		return mssql_affected_rows( $this->_resource );
	}

	/**
	* Execute a batch query
	* @return mixed A database resource if successful, FALSE if not.
	*/
	function queryBatch( $abort_on_error=true, $p_transaction_safe = false)
	{
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		if ($p_transaction_safe) {
			$si = mssql_get_server_info( $this->_resource );
			preg_match_all( "/(\d+)\.(\d+)\.(\d+)/i", $si, $m );
			if ($m[1] >= 4) {
				$this->_sql = 'START TRANSACTION;' . $this->_sql . '; COMMIT;';
			} else if ($m[2] >= 23 && $m[3] >= 19) {
				$this->_sql = 'BEGIN WORK;' . $this->_sql . '; COMMIT;';
			} else if ($m[2] >= 23 && $m[3] >= 17) {
				$this->_sql = 'BEGIN;' . $this->_sql . '; COMMIT;';
			}
		}
		$query_split = preg_split ("/[;]+/", $this->_sql);
		$error = 0;
		foreach ($query_split as $command_line) {
			$command_line = trim( $command_line );
			if ($command_line != '') {
				$this->_cursor = mssql_query( $command_line, $this->_resource );
				if (!$this->_cursor) {
					$error = 1;
					$this->_errorNum .= mssql_errno( $this->_resource ) . ' ';
					$this->_errorMsg .= mssql_error( $this->_resource )." SQL=$command_line <br />";
					if ($abort_on_error) {
						return $this->_cursor;
					}
				}
			}
		}
		return $error ? false : true;
	}

	/**
	* Diagnostic function
	*/
	function explain()
	{
		$temp = $this->_sql;
		$this->_sql = "EXPLAIN $this->_sql";
		$this->query();

		if (!($cur = $this->query())) {
			return null;
		}
		$first = true;

		$buffer = '<table id="explain-sql">';
		$buffer .= '<thead><tr><td colspan="99">'.$this->getQuery().'</td></tr>';
		while ($row = mssql_fetch_assoc( $cur )) {
			if ($first) {
				$buffer .= '<tr>';
				foreach ($row as $k=>$v) {
					$buffer .= '<th>'.$k.'</th>';
				}
				$buffer .= '</tr>';
				$first = false;
			}
			$buffer .= '</thead><tbody><tr>';
			foreach ($row as $k=>$v) {
				$buffer .= '<td>'.$v.'</td>';
			}
			$buffer .= '</tr>';
		}
		$buffer .= '</tbody></table>';
		mssql_free_result( $cur );

		$this->_sql = $temp;

		return $buffer;
	}
	/**
	* @return int The number of rows returned from the most recent query.
	*/
	function getNumRows( $cur=null )
	{
		return mssql_num_rows( $cur ? $cur : $this->_cursor );
	}

	/**
	* This method loads the first field of the first row returned by the query.
	*
	* @return The value returned in the query or null if the query failed.
	*/
	function loadResult()
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$ret = null;
		if ($row = mssql_fetch_row( $cur )) {
			$ret = $row[0];
		}
		mssql_free_result( $cur );
		return $ret;
	}
	/**
	* Load an array of single field results into an array
	*/
	function loadResultArray($numinarray = 0)
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mssql_fetch_row( $cur )) {
			$array[] = $row[$numinarray];
		}
		mssql_free_result( $cur );
		return $array;
	}

	/**
	* Fetch a result row as an associative array
	*
	* return array
	*/
	function loadAssoc()
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$ret = null;
		if ($array = mssql_fetch_assoc( $cur )) {
			$ret = $array;
		}
		mssql_free_result( $cur );
		return $ret;
	}

	/**
	* Load a assoc list of database rows
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	*/
	function loadAssocList( $key='' )
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mssql_fetch_assoc( $cur )) {
			if ($key) {
				$array[$row[$key]] = $row;
			} else {
				$array[] = $row;
			}
		}
		mssql_free_result( $cur );
		return $array;
	}
	/**
	* This global function loads the first row of a query into an object
	*
	* return object
	*/
	function loadObject( )
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$ret = null;
		if ($object = mssql_fetch_object( $cur )) {
			$ret = $object;
		}
		mssql_free_result( $cur );
		return $ret;
	}
	/**
	* Load a list of database objects
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function loadObjectList( $key='' )
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mssql_fetch_object( $cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mssql_free_result( $cur );
		return $array;
	}
	/**
	* @return The first row of the query.
	*/
	function loadRow()
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$ret = null;
		if ($row = mssql_fetch_row( $cur )) {
			$ret = $row;
		}
		mssql_free_result( $cur );
		return $ret;
	}
	/**
	* Load a list of database rows (numeric column indexing)
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function loadRowList( $key=null )
	{
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mssql_fetch_row( $cur )) {
			if ($key !== null) {
				$array[$row[$key]] = $row;
			} else {
				$array[] = $row;
			}
		}
		mssql_free_result( $cur );
		return $array;
	}
	/**
	 * Inserts a row into a table based on an objects properties
	 * @param	string	The name of the table
	 * @param	object	An object whose properties match table fields
	 * @param	string	The name of the primary key. If provided the object property is updated.
	 */
	function insertObject( $table, &$object, $keyName = NULL )
	{
		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		$fields = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$fields[] = $this->nameQuote( $k );;
			$values[] = $this->isQuoted( $k ) ? $this->Quote( $v ) : $v;
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		if (!$this->query()) {
			return false;
		}
		$id = $this->insertid();
		if ($keyName && $id) {
			$object->$keyName = $id;
		}
		return true;
	}

	/**
	 * Document::db_updateObject()
	 * @param [type] $updateNulls
	 */
	function updateObject( $table, &$object, $keyName, $updateNulls=true )
	{
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		$tmp = array();
		foreach (get_object_vars( $object ) as $k => $v)
		{
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
			if( $k == $keyName ) { // PK not to be updated
				$where = $keyName . '=' . $this->Quote( $v );
				continue;
			}
			if ($v === null)
			{
				if ($updateNulls) {
					$val = 'NULL';
				} else {
					continue;
				}
			} else {
				$val = $this->isQuoted( $k ) ? $this->Quote( $v ) : $v;
			}
			$tmp[] = $this->nameQuote( $k ) . '=' . $val;
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}

	function insertid()
	{
		$id = false;
		$rs = mssql_query("SELECT @@identity AS id", $this->_resource);
		if ($row = mssql_fetch_row($rs)) {
			$id = trim($row[0]);
		}
		mssql_free_result($rs);
		
		return $id;
	}

	function getVersion()
	{
		return;
	}
	/**
	 * Assumes database collation in use by sampling one text field in one table
	 * @return string Collation in use
	 */
	function getCollation ()
	{
		if ( $this->hasUTF() ) {
			$this->setQuery( 'SHOW FULL COLUMNS FROM #__content' );
			$array = $this->loadAssocList();
			return $array['4']['Collation'];
		} else {
			return "N/A (mySQL < 4.1.2)";
		}
	}

	/**
	 * @return array A list of all the tables in the database
	 */
	function getTableList()
	{
		$this->setQuery( 'SHOW TABLES' );
		return $this->loadResultArray();
	}
	/**
	 * @param array A list of table names
	 * @return array A list the create SQL for the tables
	 */
	function getTableCreate( $tables )
	{
		$result = array();

		foreach ($tables as $tblval) {
			$this->setQuery( 'SHOW CREATE table ' . $this->getEscaped( $tblval ) );
			$rows = $this->loadRowList();
			foreach ($rows as $row) {
				$result[$tblval] = $row[1];
			}
		}

		return $result;
	}
	/**
	 * @param array A list of table names
	 * @return array An array of fields by table
	 */
	function getTableFields( $tables )
	{
		$result = array();

		foreach ($tables as $tblval) {
			$this->setQuery( 'SHOW FIELDS FROM ' . $tblval );
			$fields = $this->loadObjectList();
			foreach ($fields as $field) {
				$result[$tblval][$field->Field] = preg_replace("/[(0-9)]/",'', $field->Type );
			}
		}

		return $result;
	}
}}