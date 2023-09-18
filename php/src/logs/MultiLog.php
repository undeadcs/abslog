<?php
namespace abslog\logs;

use abslog\Log;
use abslog\Record;

/**
 * Logging to multiple logs
 */
class MultiLog implements Log {
	/**
	 * Logs to log to
	 */
	protected array $logs = [ ];

	/**
	 * Constructor
	 * 
	 * @param Log $logs Logs to log to
	 */
	public function __construct( Log ...$logs ) {
		$this->logs = $logs;
	}

	/**
	 * Get logs
	 */
	public function GetLogs( ) : array {
		return $this->logs;
	}

	/**
	 * Add log
	 */
	public function AddLog( Log $log ) : MultiLog {
		$this->logs[ ] = $log;

		return $this;
	}

	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void {
		foreach( $this->logs as $log ) {
			$log->Write( $record );
		}
	}
}
