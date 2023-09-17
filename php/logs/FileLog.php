<?php
namespace abslog\logs;

use abslog\Log;
use abslog\Record;

/**
 * Logging to file by name
 */
class FileLog extends TextualLog implements Log {
	/**
	 * Full file path
	 */
	protected string $filename = '';

	/**
	 * Constructor
	 * 
	 * @param string $filename Full file path
	 */
	public function __construct( string $filename ) {
		$this->filename = $filename;
	}

	/**
	 * Get file path
	 */
	public function GetFilename( ) : string {
		return $this->filename;
	}
	
	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void {
		file_put_contents( $this->filename, $this->RecordToString( $record ), FILE_APPEND );
	}
}
