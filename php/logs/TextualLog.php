<?php
namespace abslog;

/**
 * Log with records converted to text
 */
abstract class TextualLog {
	/**
	 * Prepare record for output
	 */
	protected function RecordToString( Record $record ) : string {
		return $record."\n";
	}
}
