<?php
namespace abslog\logs;

use abslog\Log;
use abslog\Record;

/**
 * Logging to file by name
 */
class FileLog extends TextualLog implements Log {
	/**
	 * @var string Full file path
	 */
	protected string $filename = '';

	public function __construct( string $filename ) {
		$this->filename = $filename;
	}

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
