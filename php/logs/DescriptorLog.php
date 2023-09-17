<?php
namespace abslog\logs;

use abslog\Log;
use abslog\Record;

/**
 * Logging to descriptor
 *
 * descriptor is not captured by instance of this class, close it on your own
 */
class DescriptorLog extends TextualLog implements Log {
	/**
	 * Descriptor to write to
	 */
	protected $fd = null;

	/**
	 * Constructor
	 * 
	 * @param mixed $fd Descriptor to write to
	 */
	public function __construct( $fd ) {
		$this->fd = $fd;
	}

	/**
	 * Get descriptor
	 */
	public function GetDescriptor( ) : mixed {
		return $this->fd;
	}

	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void {
		fwrite( $this->fd, $this->RecordToString( $record ) );
	}
}
