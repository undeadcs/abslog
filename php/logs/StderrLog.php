<?php
namespace abslog;

/**
 * Logging to STDERR
 */
class StderrLog extends DescriptorLog {
	public function __construct( ) {
		parent::__construct( STDERR );
	}
}
