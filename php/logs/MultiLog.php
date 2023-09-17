<?php
namespace abslog;

/**
 * Logging to multiple logs
 */
class MultiLog implements Log {
	/**
	 * @var array Array for logs to log to
	 */
	protected array $logs = [ ];

	public function __construct( Log ...$logs ) {
		$this->logs = $logs;
	}

	public function GetLogs( ) : array {
		return $this->logs;
	}

	/**
	 * Add log to array
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
