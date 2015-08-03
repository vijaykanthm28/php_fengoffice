<?php 
  /**
  * BaseMembers class
  *
  * @author Diego Castiglioni <diego.castiglioni@fengoffice.com>
  */
  abstract class BaseMembers extends DataManager {
  
    /**
    * Column name => Column type map
    *
    * @var array
    * @static
    */
    static private $columns = array(
    	'id' => DATA_TYPE_INTEGER, 
    	'dimension_id' => DATA_TYPE_INTEGER,
    	'object_type_id' => DATA_TYPE_INTEGER,
    	'parent_member_id' => DATA_TYPE_INTEGER, 
    	'depth' => DATA_TYPE_INTEGER, 
    	'name' => DATA_TYPE_STRING, 
    	'object_id' => DATA_TYPE_INTEGER,
    	'archived_on' => DATA_TYPE_DATETIME,
    	'archived_by_id' => DATA_TYPE_INTEGER,
    	'color' => DATA_TYPE_INTEGER,
    	'order' => DATA_TYPE_INTEGER,
    );
  
    /**
    * Construct
    *
    * @return BaseMembers 
    */
    function __construct() {
      Hook::fire('object_definition', 'Member', self::$columns);
      parent::__construct('Member', 'members', true);
    } // __construct
    
    // -------------------------------------------------------
    //  Description methods
    // -------------------------------------------------------
    
    /**
    * Return array of object columns
    *
    * @access public
    * @param void
    * @return array
    */
    function getColumns() {
      return array_keys(self::$columns);
    } // getColumns
    
    /**
    * Return column type
    *
    * @access public
    * @param string $column_name
    * @return string
    */
    function getColumnType($column_name) {
      if(isset(self::$columns[$column_name])) {
        return self::$columns[$column_name];
      } else {
        return DATA_TYPE_STRING;
      } // if
    } // getColumnType
    
    /**
    * Return array of PK columns. If only one column is PK returns its name as string
    *
    * @access public
    * @param void
    * @return array or string
    */
    function getPkColumns() {
      return 'id';
    } // getPkColumns
    
    /**
    * Return name of first auto_incremenent column if it exists
    *
    * @access public
    * @param void
    * @return string
    */
    function getAutoIncrementColumn() {
      return 'id';
    } // getAutoIncrementColumn
    
    // -------------------------------------------------------
    //  Finders
    // -------------------------------------------------------
    
    /**
    * Do a SELECT query over database with specified arguments
    *
    * @access public
    * @param array $arguments Array of query arguments. Fields:
    * 
    *  - one - select first row
    *  - conditions - additional conditions
    *  - order - order by string
    *  - offset - limit offset, valid only if limit is present
    *  - limit
    * 
    * @return one or Members objects
    * @throws DBQueryError
    */
    function find($arguments = null) {
      if(isset($this) && instance_of($this, 'Members')) {
        return parent::find($arguments);
      } else {
        return Members::instance()->find($arguments);
      } // if
    } // find
    
    /**
    * Find all records
    *
    * @access public
    * @param array $arguments
    * @return one or Members objects
    */
    function findAll($arguments = null) {
      if(isset($this) && instance_of($this, 'Members')) {
        return parent::findAll($arguments);
      } else {
        return Members::instance()->findAll($arguments);
      } // if
    } // findAll
    
    /**
    * Find one specific record
    *
    * @access public
    * @param array $arguments
    * @return Member 
    */
    function findOne($arguments = null) {
      if(isset($this) && instance_of($this, 'Members')) {
        return parent::findOne($arguments);
      } else {
        return Members::instance()->findOne($arguments);
      } // if
    } // findOne
    
    /**
    * Return object by its PK value
    *
    * @access public
    * @param mixed $id
    * @param boolean $force_reload If true cache will be skipped and data will be loaded from database
    * @return Member 
    */
    function findById($id, $force_reload = false) {
      if(isset($this) && instance_of($this, 'Members')) {
        return parent::findById($id, $force_reload);
      } else {
        return Members::instance()->findById($id, $force_reload);
      } // if
    } // findById
    
    /**
    * Return number of rows in this table
    *
    * @access public
    * @param string $conditions Query conditions
    * @return integer
    */
    function count($condition = null) {
      if(isset($this) && instance_of($this, 'Members')) {
        return parent::count($condition);
      } else {
        return Members::instance()->count($condition);
      } // if
    } // count
    
    /**
    * Delete rows that match specific conditions. If $conditions is NULL all rows from table will be deleted
    *
    * @access public
    * @param string $conditions Query conditions
    * @return boolean
    */
    function delete($condition = null) {
      if(isset($this) && instance_of($this, 'Members')) {
        return parent::delete($condition);
      } else {
        return Members::instance()->delete($condition);
      } // if
    } // delete
    
    /**
    * This function will return paginated result. Result is an array where first element is 
    * array of returned object and second populated pagination object that can be used for 
    * obtaining and rendering pagination data using various helpers.
    * 
    * Items and pagination array vars are indexed with 0 for items and 1 for pagination
    * because you can't use associative indexing with list() construct
    *
    * @access public
    * @param array $arguments Query argumens (@see find()) Limit and offset are ignored!
    * @param integer $items_per_page Number of items per page
    * @param integer $current_page Current page number
    * @return array
    */
    function paginate($arguments = null, $items_per_page = 10, $current_page = 1) {
      if(isset($this) && instance_of($this, 'Members')) {
        return parent::paginate($arguments, $items_per_page, $current_page);
      } else {
        return Members::instance()->paginate($arguments, $items_per_page, $current_page);
      } // if
    } // paginate
    
    /**
    * Return manager instance
    *
    * @return Members 
    */
    function instance() {
      static $instance;
      if(!instance_of($instance, 'Members')) {
        $instance = new Members();
      } // if
      return $instance;
    } // instance
  
  } // BaseMembers 

?>