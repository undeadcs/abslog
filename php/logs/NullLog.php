<?php
namespace abslog\logs;

use abslog\Log;
use abslog\Record;

/**
 * Logging nowhere
 */
class NullLog implements Log {
	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void { }
}
