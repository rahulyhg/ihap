<?php 
/**
* @package Jabali Framework
* @subpackage Jabali Database Access Abstraction Object
* @link https://docs.mauko.co.ke/jabali/classes/hdb
* @author Mauko Maunde
* @version 0.17.06
**/

class _hDb {

	var $show_errors = false;
	var $suppress_errors = false;
	public $last_error = '';
	public $num_queries = 0;
	public $num_rows = 0;
	var $rows_affected = 0;
	public $insert_id = 0;
	var $last_query;
	var $last_result;
	protected $result;
	protected $col_meta = array();
	protected $table_charset = array();
	protected $check_current_query = true;
	private $checking_collation = false;
	protected $col_info;
	var $queries;
	protected $reconnect_retries = 5;
	public $prefix = '';
	 public $base_prefix;
	var $ready = false;
	public $blogid = 0;
	public $siteid = 0;
	var $tables = array( 'posts', 'comments', 'links', 'options', 'postmeta',
		'terms', 'term_taxonomy', 'term_relationships', 'termmeta', 'commentmeta' );
	var $old_tables = array( 'categories', 'post2cat', 'link2cat' );
	var $global_tables = array( 'users', 'usermeta' );
	var $ms_global_tables = array( 'blogs', 'signups', 'site', 'sitemeta',
		'sitecategories', 'registration_log', 'blog_versions' );
	public $comments;
	public $commentmeta;
	public $links;
	public $options;
	public $postmeta;
	public $posts;
	public $terms;
	public $term_relationships;
	public $term_taxonomy;
	public $termmeta;
	public $usermeta;
	public $users;
	public $blogs;
	public $blog_versions;
	public $registration_log;
	public $signups;
	public $site;
	public $sitecategories;
	public $sitemeta;
	public $field_types = array();
	public $charset;
	public $collate;
	protected $dbuser;
	protected $dbpassword;
	protected $dbname;
	protected $dbhost;
	protected $dbh;
	public $func_call;
	public $is_mysql = null;
	protected $incompatible_modes = array( 'NO_ZERO_DATE', 'ONLY_FULL_GROUP_BY',
		'STRICT_TRANS_TABLES', 'STRICT_ALL_TABLES', 'TRADITIONAL' );
	private $use_mysqli = false;
	private $has_connected = false;



	public function __construct( $hdbuser, $hdbpassword, $hdbname, $hdbhost ) {

		$this->hdbuser = hDBUSER;
		$this->hdbpassword = hDBPASS;
		$this->hdbname = hDBNAME;
		$this->hdbhost = hDBHOST;

		$this->db_connect();
	}

	public function __destruct() {
		return true;
	}

	public function __get( $name ) {
		if ( 'col_info' === $name )
			$this->load_col_info();

		return $this->$name;
	}

	/**
	 * Makes private properties settable for backward compatibility.
	 *
	 * @since 3.5.0
	 *
	 * @param string $name  The private member to set
	 * @param mixed  $value The value to set
	 */
	public function __set( $name, $value ) {
		$protected_members = array(
			'col_meta',
			'table_charset',
			'check_current_query',
		 );
		if (  in_array( $name, $protected_members, true ) ) {
			return;
		}
		$this->$name = $value;
	}

	/**
	 * Makes private properties check-able for backward compatibility.
	 *
	 * @since 3.5.0
	 *
	 * @param string $name  The private member to check
	 *
	 * @return bool If the member is set or not
	 */
	public function __isset( $name ) {
		return isset( $this->$name );
	}

	/**
	 * Makes private properties un-settable for backward compatibility.
	 *
	 * @since 3.5.0
	 *
	 * @param string $name  The private member to unset
	 */
	public function __unset( $name ) {
		unset( $this->$name );
	}

	public function set_prefix( $prefix, $set_table_names = true ) {

		if ( preg_match( '|[^a-z0-9_]|i', $prefix ) )
			return new WP_Error('invalid_db_prefix', 'Invalid database prefix' );

		$old_prefix = is_multisite() ? '' : $prefix;

		if ( isset( $this->base_prefix ) )
			$old_prefix = $this->base_prefix;

		$this->base_prefix = $prefix;

		if ( $set_table_names ) {
			foreach ( $this->tables( 'global' ) as $table => $prefixed_table )
				$this->$table = $prefixed_table;

			if ( is_multisite() && empty( $this->blogid ) )
				return $old_prefix;

			$this->prefix = $this->get_blog_prefix();

			foreach ( $this->tables( 'blog' ) as $table => $prefixed_table )
				$this->$table = $prefixed_table;

			foreach ( $this->tables( 'old' ) as $table => $prefixed_table )
				$this->$table = $prefixed_table;
		}
		return $old_prefix;
	}

	function _real_escape( $string ) {
		if ( $this->dbh ) {
			if ( $this->use_mysqli ) {
				return mysqli_real_escape_string( $this->dbh, $string );
			} else {
				return mysql_real_escape_string( $string, $this->dbh );
			}
		}
	}

	public function db_connect( $allow_bail = true ) {
		$this->is_mysql = true;

		$dbh = mysql_connect( $this->dbhost, $this->dbuser, $this->dbpassword, $new_link, $client_flags );
	}

	public function check_connection( $allow_bail = true ) {
		if ( $this->use_mysqli ) {
			if ( ! empty( $this->dbh ) && mysqli_ping( $this->dbh ) ) {
				return true;
			}
		} else {
			if ( ! empty( $this->dbh ) && mysql_ping( $this->dbh ) ) {
				return true;
			}
		}
	}

	public function query( $query ) {
		if ( ! $this->ready ) {
			$this->check_current_query = true;
			return false;
		}

		$query = apply_filters( 'query', $query );

		$this->flush();

		// Log how the function was called
		$this->func_call = "\$db->query(\"$query\" )";

		// If we're writing to the database, make sure the query will write safely.
		if ( $this->check_current_query && ! $this->check_ascii( $query ) ) {
			$stripped_query = $this->strip_invalid_text_from_query( $query );
			// strip_invalid_text_from_query() can perform queries, so we need
			// to flush again, just to make sure everything is clear.
			$this->flush();
			if ( $stripped_query !== $query ) {
				$this->insert_id = 0;
				return false;
			}
		}

		$this->check_current_query = true;

		// Keep track of the last query for debug.
		$this->last_query = $query;

		$this->_do_query( $query );

		// MySQL server has gone away, try to reconnect.
		$mysql_errno = 0;
		if ( ! empty( $this->dbh ) ) {
			if ( $this->use_mysqli ) {
				if ( $this->dbh instanceof mysqli ) {
					$mysql_errno = mysqli_errno( $this->dbh );
				} else {
					// $dbh is defined, but isn't a real connection.
					// Something has gone horribly wrong, let's try a reconnect.
					$mysql_errno = 2006;
				}
			} else {
				if ( is_resource( $this->dbh ) ) {
					$mysql_errno = mysql_errno( $this->dbh );
				} else {
					$mysql_errno = 2006;
				}
			}
		}

		if ( empty( $this->dbh ) || 2006 == $mysql_errno ) {
			if ( $this->check_connection() ) {
				$this->_do_query( $query );
			} else {
				$this->insert_id = 0;
				return false;
			}
		}

		// If there is an error then take note of it.
		if ( $this->use_mysqli ) {
			if ( $this->dbh instanceof mysqli ) {
				$this->last_error = mysqli_error( $this->dbh );
			} else {
				$this->last_error = __( 'Unable to retrieve the error message from MySQL' );
			}
		} else {
			if ( is_resource( $this->dbh ) ) {
				$this->last_error = mysql_error( $this->dbh );
			} else {
				$this->last_error = __( 'Unable to retrieve the error message from MySQL' );
			}
		}

		if ( $this->last_error ) {
			// Clear insert_id on a subsequent failed insert.
			if ( $this->insert_id && preg_match( '/^\s*(insert|replace)\s/i', $query ) )
				$this->insert_id = 0;

			$this->print_error();
			return false;
		}

		if ( preg_match( '/^\s*(create|alter|truncate|drop)\s/i', $query ) ) {
			$return_val = $this->result;
		} elseif ( preg_match( '/^\s*(insert|delete|update|replace)\s/i', $query ) ) {
			if ( $this->use_mysqli ) {
				$this->rows_affected = mysqli_affected_rows( $this->dbh );
			} else {
				$this->rows_affected = mysql_affected_rows( $this->dbh );
			}
			// Take note of the insert_id
			if ( preg_match( '/^\s*(insert|replace)\s/i', $query ) ) {
				if ( $this->use_mysqli ) {
					$this->insert_id = mysqli_insert_id( $this->dbh );
				} else {
					$this->insert_id = mysql_insert_id( $this->dbh );
				}
			}
			// Return number of rows affected
			$return_val = $this->rows_affected;
		} else {
			$num_rows = 0;
			if ( $this->use_mysqli && $this->result instanceof mysqli_result ) {
				while ( $row = mysqli_fetch_object( $this->result ) ) {
					$this->last_result[$num_rows] = $row;
					$num_rows++;
				}
			} elseif ( is_resource( $this->result ) ) {
				while ( $row = mysql_fetch_object( $this->result ) ) {
					$this->last_result[$num_rows] = $row;
					$num_rows++;
				}
			}

			// Log number of rows the query returned
			// and return number of rows selected
			$this->num_rows = $num_rows;
			$return_val     = $num_rows;
		}

		return $return_val;
	}

	private function _do_query( $query ) {
		if ( defined( 'SAVEQUERIES' ) && SAVEQUERIES ) {
			$this->timer_start();
		}

		if ( ! empty( $this->dbh ) && $this->use_mysqli ) {
			$this->result = mysqli_query( $this->dbh, $query );
		} elseif ( ! empty( $this->dbh ) ) {
			$this->result = mysql_query( $query, $this->dbh );
		}
		$this->num_queries++;

		if ( defined( 'SAVEQUERIES' ) && SAVEQUERIES ) {
			$this->queries[] = array( $query, $this->timer_stop(), $this->get_caller() );
		}
	}

	public function insert( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'INSERT' );
	}

	public function replace( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'REPLACE' );
	}

	function _insert_replace_helper( $table, $data, $format = null, $type = 'INSERT' ) {
		$this->insert_id = 0;

		if ( ! in_array( strtoupper( $type ), array( 'REPLACE', 'INSERT' ) ) ) {
			return false;
		}

		$data = $this->process_fields( $table, $data, $format );
		if ( false === $data ) {
			return false;
		}

		$formats = $values = array();
		foreach ( $data as $value ) {
			if ( is_null( $value['value'] ) ) {
				$formats[] = 'NULL';
				continue;
			}

			$formats[] = $value['format'];
			$values[]  = $value['value'];
		}

		$fields  = '`' . implode( '`, `', array_keys( $data ) ) . '`';
		$formats = implode( ', ', $formats );

		$sql = "$type INTO `$table` ( $fields) VALUES ( $formats)";

		$this->check_current_query = false;
		return $this->query( $this->prepare( $sql, $values ) );
	}

	public function update( $table, $data, $where, $format = null, $where_format = null ) {
		if ( ! is_array( $data ) || ! is_array( $where ) ) {
			return false;
		}

		$data = $this->process_fields( $table, $data, $format );
		if ( false === $data ) {
			return false;
		}
		$where = $this->process_fields( $table, $where, $where_format );
		if ( false === $where ) {
			return false;
		}

		$fields = $conditions = $values = array();
		foreach ( $data as $field => $value ) {
			if ( is_null( $value['value'] ) ) {
				$fields[] = "`$field` = NULL";
				continue;
			}

			$fields[] = "`$field` = " . $value['format'];
			$values[] = $value['value'];
		}
		foreach ( $where as $field => $value ) {
			if ( is_null( $value['value'] ) ) {
				$conditions[] = "`$field` IS NULL";
				continue;
			}

			$conditions[] = "`$field` = " . $value['format'];
			$values[] = $value['value'];
		}

		$fields = implode( ', ', $fields );
		$conditions = implode( ' AND ', $conditions );

		$sql = "UPDATE `$table` SET $fields WHERE $conditions";

		$this->check_current_query = false;
		return $this->query( $this->prepare( $sql, $values ) );
	}

	public function delete( $table, $where, $where_format = null ) {
		if ( ! is_array( $where ) ) {
			return false;
		}

		$where = $this->process_fields( $table, $where, $where_format );
		if ( false === $where ) {
			return false;
		}

		$conditions = $values = array();
		foreach ( $where as $field => $value ) {
			if ( is_null( $value['value'] ) ) {
				$conditions[] = "`$field` IS NULL";
				continue;
			}

			$conditions[] = "`$field` = " . $value['format'];
			$values[] = $value['value'];
		}

		$conditions = implode( ' AND ', $conditions );

		$sql = "DELETE FROM `$table` WHERE $conditions";

		$this->check_current_query = false;
		return $this->query( $this->prepare( $sql, $values ) );
	}

	protected function process_fields( $table, $data, $format ) {
		$data = $this->process_field_formats( $data, $format );
		if ( false === $data ) {
			return false;
		}

		$data = $this->process_field_charsets( $data, $table );
		if ( false === $data ) {
			return false;
		}

		$data = $this->process_field_lengths( $data, $table );
		if ( false === $data ) {
			return false;
		}

		$converted_data = $this->strip_invalid_text( $data );

		if ( $data !== $converted_data ) {
			return false;
		}

		return $data;
	}

	protected function process_field_formats( $data, $format ) {
		$formats = $original_formats = (array) $format;

		foreach ( $data as $field => $value ) {
			$value = array(
				'value'  => $value,
				'format' => '%s',
			 );

			if ( ! empty( $format ) ) {
				$value['format'] = array_shift( $formats );
				if ( ! $value['format'] ) {
					$value['format'] = reset( $original_formats );
				}
			} elseif ( isset( $this->field_types[ $field ] ) ) {
				$value['format'] = $this->field_types[ $field ];
			}

			$data[ $field ] = $value;
		}

		return $data;
	}

	protected function process_field_charsets( $data, $table ) {
		foreach ( $data as $field => $value ) {
			if ( '%d' === $value['format'] || '%f' === $value['format'] ) {
				/*
				 * We can skip this field if we know it isn't a string.
				 * This checks %d/%f versus ! %s because its sprintf() could take more.
				 */
				$value['charset'] = false;
			} else {
				$value['charset'] = $this->get_col_charset( $table, $field );
				if ( is_wp_error( $value['charset'] ) ) {
					return false;
				}
			}

			$data[ $field ] = $value;
		}

		return $data;
	}

	protected function process_field_lengths( $data, $table ) {
		foreach ( $data as $field => $value ) {
			if ( '%d' === $value['format'] || '%f' === $value['format'] ) {
				/*
				 * We can skip this field if we know it isn't a string.
				 * This checks %d/%f versus ! %s because its sprintf() could take more.
				 */
				$value['length'] = false;
			} else {
				$value['length'] = $this->get_col_length( $table, $field );
				if ( is_wp_error( $value['length'] ) ) {
					return false;
				}
			}

			$data[ $field ] = $value;
		}

		return $data;
	}

	public function get_var( $query = null, $x = 0, $y = 0 ) {
		$this->func_call = "\$db->get_var(\"$query\", $x, $y)";

		if ( $this->check_current_query && $this->check_safe_collation( $query ) ) {
			$this->check_current_query = false;
		}

		if ( $query ) {
			$this->query( $query );
		}

		// Extract var out of cached results based x,y vals
		if ( !empty( $this->last_result[$y] ) ) {
			$values = array_values( get_object_vars( $this->last_result[$y] ) );
		}

		// If there is a value return it else return null
		return ( isset( $values[$x] ) && $values[$x] !== '' ) ? $values[$x] : null;
	}

	public function get_row( $query = null, $output = OBJECT, $y = 0 ) {
		$this->func_call = "\$db->get_row(\"$query\",$output,$y)";

		if ( $this->check_current_query && $this->check_safe_collation( $query ) ) {
			$this->check_current_query = false;
		}

		if ( $query ) {
			$this->query( $query );
		} else {
			return null;
		}

		if ( !isset( $this->last_result[$y] ) )
			return null;

		if ( $output == OBJECT ) {
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} elseif ( $output == ARRAY_A ) {
			return $this->last_result[$y] ? get_object_vars( $this->last_result[$y] ) : null;
		} elseif ( $output == ARRAY_N ) {
			return $this->last_result[$y] ? array_values( get_object_vars( $this->last_result[$y] ) ) : null;
		} elseif ( strtoupper( $output ) === OBJECT ) {
			// Back compat for OBJECT being previously case insensitive.
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} else {
			$this->print_error( " \$db->get_row(string query, output type, int offset) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N" );
		}
	}

	public function get_col( $query = null , $x = 0 ) {
		if ( $this->check_current_query && $this->check_safe_collation( $query ) ) {
			$this->check_current_query = false;
		}

		if ( $query ) {
			$this->query( $query );
		}

		$new_array = array();
		// Extract the column values
		for ( $i = 0, $j = count( $this->last_result ); $i < $j; $i++ ) {
			$new_array[$i] = $this->get_var( null, $x, $i );
		}
		return $new_array;
	}

	public function get_results( $query = null, $output = OBJECT ) {
		$this->func_call = "\$db->get_results(\"$query\", $output)";

		if ( $this->check_current_query && $this->check_safe_collation( $query ) ) {
			$this->check_current_query = false;
		}

		if ( $query ) {
			$this->query( $query );
		} else {
			return null;
		}

		$new_array = array();
		if ( $output == OBJECT ) {
			// Return an integer-keyed array of row objects
			return $this->last_result;
		} elseif ( $output == OBJECT_K ) {
			// Return an array of row objects with keys from column 1
			// (Duplicates are discarded)
			foreach ( $this->last_result as $row ) {
				$var_by_ref = get_object_vars( $row );
				$key = array_shift( $var_by_ref );
				if ( ! isset( $new_array[ $key ] ) )
					$new_array[ $key ] = $row;
			}
			return $new_array;
		} elseif ( $output == ARRAY_A || $output == ARRAY_N ) {
			// Return an integer-keyed array of...
			if ( $this->last_result ) {
				foreach ( (array) $this->last_result as $row ) {
					if ( $output == ARRAY_N ) {
						// ...integer-keyed row arrays
						$new_array[] = array_values( get_object_vars( $row ) );
					} else {
						// ...column name-keyed row arrays
						$new_array[] = get_object_vars( $row );
					}
				}
			}
			return $new_array;
		} elseif ( strtoupper( $output ) === OBJECT ) {
			// Back compat for OBJECT being previously case insensitive.
			return $this->last_result;
		}
		return null;
	}

	protected function get_table_from_query( $query ) {
		// Remove characters that can legally trail the table name.
		$query = rtrim( $query, ';/-#' );

		// Allow (select...) union [...] style queries. Use the first query's table name.
		$query = ltrim( $query, "\r\n\t ( " );

		// Strip everything between parentheses except nested selects.
		$query = preg_replace( '/\((?!\s*select)[^(]*?\)/is', '()', $query );

		// Quickly match most common queries.
		if ( preg_match( '/^\s*(?:'
				. 'SELECT.*?\s+FROM'
				. '|INSERT(?:\s+LOW_PRIORITY|\s+DELAYED|\s+HIGH_PRIORITY)?(?:\s+IGNORE)?(?:\s+INTO)?'
				. '|REPLACE(?:\s+LOW_PRIORITY|\s+DELAYED)?(?:\s+INTO)?'
				. '|UPDATE(?:\s+LOW_PRIORITY)?(?:\s+IGNORE)?'
				. '|DELETE(?:\s+LOW_PRIORITY|\s+QUICK|\s+IGNORE)*(?:.+?FROM)?'
				. ' )\s+((?:[0-9a-zA-Z$_.`-]|[\xC2-\xDF][\x80-\xBF] )+)/is', $query, $maybe ) ) {
			return str_replace( '`', '', $maybe[1] );
		}

		// SHOW TABLE STATUS and SHOW TABLES WHERE Name = 'wp_posts'
		if ( preg_match( '/^\s*SHOW\s+(?:TABLE\s+STATUS|(?:FULL\s+)?TABLES).+WHERE\s+Name\s*=\s*( "|\' )((?:[0-9a-zA-Z$_.-]|[\xC2-\xDF][\x80-\xBF] )+)\\1/is', $query, $maybe ) ) {
			return $maybe[2];
		}

		// SHOW TABLE STATUS LIKE and SHOW TABLES LIKE 'wp\_123\_%'
		// This quoted LIKE operand seldom holds a full table name.
		// It is usually a pattern for matching a prefix so we just
		// strip the trailing % and unescape the _ to get 'wp_123_'
		// which drop-ins can use for routing these SQL statements.
		if ( preg_match( '/^\s*SHOW\s+(?:TABLE\s+STATUS|(?:FULL\s+)?TABLES)\s+(?:WHERE\s+Name\s+)?LIKE\s*( "|\' )((?:[\\\\0-9a-zA-Z$_.-]|[\xC2-\xDF][\x80-\xBF] )+)%?\\1/is', $query, $maybe ) ) {
			return str_replace( '\\_', '_', $maybe[2] );
		}

		// Big pattern for the rest of the table-related queries.
		if ( preg_match( '/^\s*(?:'
				. '(?:EXPLAIN\s+(?:EXTENDED\s+)?)?SELECT.*?\s+FROM'
				. '|DESCRIBE|DESC|EXPLAIN|HANDLER'
				. '|(?:LOCK|UNLOCK)\s+TABLE(?:S)?'
				. '|(?:RENAME|OPTIMIZE|BACKUP|RESTORE|CHECK|CHECKSUM|ANALYZE|REPAIR).*\s+TABLE'
				. '|TRUNCATE(?:\s+TABLE)?'
				. '|CREATE(?:\s+TEMPORARY)?\s+TABLE(?:\s+IF\s+NOT\s+EXISTS)?'
				. '|ALTER(?:\s+IGNORE)?\s+TABLE'
				. '|DROP\s+TABLE(?:\s+IF\s+EXISTS)?'
				. '|CREATE(?:\s+\w+)?\s+INDEX.*\s+ON'
				. '|DROP\s+INDEX.*\s+ON'
				. '|LOAD\s+DATA.*INFILE.*INTO\s+TABLE'
				. '|(?:GRANT|REVOKE).*ON\s+TABLE'
				. '|SHOW\s+(?:.*FROM|.*TABLE)'
				. ' )\s+\(*\s*((?:[0-9a-zA-Z$_.`-]|[\xC2-\xDF][\x80-\xBF] )+)\s*\)*/is', $query, $maybe ) ) {
			return str_replace( '`', '', $maybe[1] );
		}

		return false;
	}

	public function close() {
		if ( ! $this->dbh ) {
			return false;
		}

		if ( $this->use_mysqli ) {
			$closed = mysqli_close( $this->dbh );
		} else {
			$closed = mysql_close( $this->dbh );
		}

		if ( $closed ) {
			$this->dbh = null;
			$this->ready = false;
			$this->has_connected = false;
		}

		return $closed;
	}

}
