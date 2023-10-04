<?php

use abslog\Record;

class ServiceRecord extends Record {
	/**
	 * Category: message
	 */
	const CATEGORY_MESSAGE = 0;
	
	/**
	 * Category: command
	 */
	const CATEGORY_COMMAND = 1;
	
	/**
	 * Category: event
	 */
	const CATEGORY_EVENT = 2;
	
	/**
	 * Message internal category
	 */
	public int $category = self::CATEGORY_MESSAGE;
	
	/**
	 * IP of host
	 */
	public string $host = '';
	
	/**
	 * Process ID
	 */
	public int $pid = 0;
	
	/**
	 * Service name
	 */
	public string $name = '';
	
	public function __construct( string $message, int $level = self::LVL_INFO, \DateTime $time = new \DateTime, int $category = self::CATEGORY_MESSAGE, string $host = '', int $pid = 0, string $name = '' ) {
		parent::__construct( $message, $level, $time );
		
		$this->host     = $host;
		$this->pid      = $pid;
		$this->name     = $name;
		$this->category = $category;
	}
	
	/**
	 * Magic method for casting to string
	 */
	public function __toString( ) : string {
		return '['.$this->time->format( 'c' ).']['.self::LevelToString( $this->level ).']['.$this->host.']['.$this->pid.']['.$this->name.']['.$this->category.'] '.$this->message;
	}
}
