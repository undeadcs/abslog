<?php
namespace abslog;

/**
 * Record in log
 * 
 * @todo make it struct for extendable case
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
	 * Level
	 */
	protected int $level = self::LVL_INFO;

	/**
	 * Message
	 */
	protected string $message = '';

	/**
	 * Constructor
	 * 
	 * @param string $message Message
	 * @param int $level Level
	 */
	public function __construct( string $message, int $level = self::LVL_INFO ) {
		$this->message	= $message;
		$this->level	= $level;
	}

	/**
	 * Get level of record
	 */
	public function GetLevel( ) : int {
		return $this->level;
	}

	/**
	 * Get message of record
	 */
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
	 * Create error record
	 */
	public static function Error( string $message ) : Record {
		return new static( $message, self::LVL_ERROR );
	}
	
	/**
	 * Create warning record
	 */
	public static function Warning( string $message ) : Record {
		return new static( $message, self::LVL_WARNING );
	}
	
	/**
	 * Create info record
	 */
	public static function Info( string $message ) : Record {
		return new static( $message, self::LVL_INFO );
	}
	
	/**
	 * Create debug record
	 */
	public static function Debug( string $message ) : Record {
		return new static( $message, self::LVL_DEBUG );
	}
	
	/**
	 * Magic method for casting to string
	 */
	public function __toString( ) : string {
		return '['.self::LevelToString( $this->level ).'] '.$this->message;
	}
}
