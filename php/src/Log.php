<?php
namespace abslog;

/**
 * Abstract interface of log
 */
interface Log {
	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void;
}
