<?php
namespace abslog;

/**
 * Logging to file by name
 */
class FileLog implements Log {
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
		file_put_contents( $this->filename, '['.Record::LevelToString( $record->GetLevel( ) ).'] '.$record->GetMessage( )."\n", FILE_APPEND );
	}
}
