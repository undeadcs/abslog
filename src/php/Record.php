<?php
namespace abslog;

/**
 * Record in log
 */
class Record implements \Stringable {
	/**
	 * Level: ERROR
	 */
	const LVL_ERROR = 0;

	/**
	 * Level: WARNING
	 */
	const LVL_WARNING = 1;

	/**
	 * Level: INFO
	 */
	const LVL_INFO = 2;

	/**
	 * Level: DEBUG
	 */
	const LVL_DEBUG = 3;

	/**
	 * @var int Level
	 */
	protected int $level = self::LVL_INFO;

	/**
	 * @var string Message
	 */
	protected string $message = '';

	public function __construct( string $message, int $level = self::LVL_INFO ) {
		$this->message	= $message;
		$this->level	= $level;
	}

	public function GetLevel( ) : int {
		return $this->level;
	}

	public function GetMessage( ) : string {
		return $this->message;
	}

	/**
	 * Integer level value to string
	 */
	public static function LevelToString( int $level ) : string {
		switch( $level ) {
			case self::LVL_ERROR:	return 'ERROR';		break;
			case self::LVL_WARNING:	return 'WARNING';	break;
			case self::LVL_INFO:	return 'INFO';		break;
			case self::LVL_DEBUG:	return 'DEBUG';		break;
		}

		return ''; // unknown
	}

	/**
	 * Simple functions for creating records
	 */
	public static function Error( string $message ) : Record {
		return new static( $message, self::LVL_ERROR );
	}
	
	public static function Warning( string $message ) : Record {
		return new static( $message, self::LVL_WARNING );
	}
	
	public static function Info( string $message ) : Record {
		return new static( $message, self::LVL_INFO );
	}
	
	public static function Debug( string $message ) : Record {
		return new static( $message, self::LVL_DEBUG );
	}
	
	public function __toString( ) : string {
		return '['.self::LevelToString( $this->level ).'] '.$this->message;
	}
}
