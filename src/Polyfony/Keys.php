<?php

namespace Polyfony;

class Keys {

	const DEFAULT_ALFO = 'sha512';

	// generate a key
	public static function generate($mixed = null) {
		// create a sha1 signature of the array with a salt
		$hash = hash(
			env('APP_KEY_ALGO') ?: self::DEFAULT_ALFO,
			json_encode([$mixed, env('APP_KEY')], JSON_NUMERIC_CHECK)
		);
		// get last 10 and first 10 chars together, convert to uppercase, return the key
		return strtoupper(substr($hash, -10) . substr($hash, 0, 10)) ;
	}

	// compare a key with a new dynamically generated one
	public static function compare(
		$key = null, 
		$mixed = null
	) {
		// if no key is provided
		if(!$key || strlen($key) != 20) {
			// return false
			return(false);	
		}
		// if keys do match
		return self::generate($mixed) == $key ?: false;
	}

}

?>
