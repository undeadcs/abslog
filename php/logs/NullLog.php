<?php
namespace abslog;

/**
 * Logging nowhere
 */
class NullLog implements Log {
	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void { }
}
