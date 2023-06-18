<?php
namespace abslog;

/**
 * Logging to STDOUT
 */
class StdoutLog extends DescriptorLog {
	public function __construct( ) {
		parent::__construct( STDOUT );
	}
}
