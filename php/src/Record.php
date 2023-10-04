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
	 * Level
	 */
	public int $level = self::LVL_INFO;

	/**
	 * Message
	 */
	public string $message = '';
	
	/**
	 * Time of creation
	 */
	public ?\DateTime $time = null;

	/**
	 * Constructor
	 * 
	 * @param string $message Message
	 * @param int $level Level
	 * @param \DateTime $time Time of creation
	 */
	public function __construct( string $message, int $level = self::LVL_INFO, \DateTime $time = new \DateTime ) {
		$this->message	= $message;
		$this->level	= $level;
		$this->time		= $time;
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
	public static function Error( string $message, ...$extra ) : Record {
		return new static( $message, self::LVL_ERROR, new \DateTime, ...$extra );
	}
	
	/**
	 * Create warning record
	 */
	public static function Warning( string $message, ...$extra ) : Record {
		return new static( $message, self::LVL_WARNING, new \DateTime, ...$extra );
	}
	
	/**
	 * Create info record
	 */
	public static function Info( string $message, ...$extra ) : Record {
		return new static( $message, self::LVL_INFO, new \DateTime, ...$extra );
	}
	
	/**
	 * Create debug record
	 */
	public static function Debug( string $message, ...$extra ) : Record {
		return new static( $message, self::LVL_DEBUG, new \DateTime, ...$extra );
	}
	
	/**
	 * Magic method for casting to string
	 */
	public function __toString( ) : string {
		return '['.$this->time->format( 'c' ).']['.self::LevelToString( $this->level ).'] '.$this->message;
	}
}
