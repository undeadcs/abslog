<?php
namespace abslog\logs;

/**
 * Logging to STDOUT
 */
class StdoutLog extends DescriptorLog {
	/**
	 * Constructor
	 */
	public function __construct( ) {
		parent::__construct( STDOUT );
	}
}
