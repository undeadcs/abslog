<?php

use abslog\Record;
use abslog\logs\FileLog;

/**
 * Logging for service
 */
class ServiceLog extends FileLog {
	protected string $name;
	protected string $host;
	
	public function __construct( string $filename, string $name, string $host ) {
		parent::__construct( $filename );
		
		$this->name = $name;
		$this->host = $host;
	}
	
	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void {
		if ( $record instanceof ServiceRecord ) {
			$record->name = $this->name;
			$record->host = $this->host;
			$record->pid = posix_getpid( );
		}
		
		parent::Write( $record );
	}
}
