<?php
namespace abslog;

/**
 * Logging to descriptor
 *
 * descriptor is not captured by instance of this class, close it on your own
 */
class DescriptorLog implements Log {
	/**
	 * @var mixed Descriptor to write to
	 */
	protected $fd = null;

	public function __construct( $fd ) {
		$this->fd = $fd;
	}

	public function GetDescriptor( ) {
		return $this->fd;
	}

	/**
	 * Write record to log
	 */
	public function Write( Record $record ) : void {
		fwrite( $this->fd, '['.Record::LevelToString( $record->GetLevel( ) ).'] '.$record->GetMessage( )."\n" );
	}
}
