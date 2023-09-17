<?php
namespace abslog\logs;

/**
 * Logging to STDERR
 */
class StderrLog extends DescriptorLog {
	public function __construct( ) {
		parent::__construct( STDERR );
	}
}
