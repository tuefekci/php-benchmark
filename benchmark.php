<?php

class Bench {

	public $mathFunctions = array("abs", "acos", "asin", "atan", "floor", "exp", "sin", "tan", "sqrt");
	public $stringFunctions = array("addslashes", "chunk_split", "metaphone", "strip_tags", "md5", "sha1", "strtoupper", "strtolower", "strrev", "strlen", "soundex", "ord");

	public function __construct() {

		foreach ($this->mathFunctions as $key => $function) {
			if (!function_exists($function)) unset($this->mathFunctions[$key]);
		}

		foreach ($this->stringFunctions as $key => $function) {
			if (!function_exists($function)) unset($this->stringFunctions[$key]);
		}

	}

	public function test_Math($ci) {
		foreach ($this->mathFunctions as $function) {
			$r = call_user_func_array($function, array($ci));
		}
	}

	public function test_StringManipulation($ci) {
		$string = "the quick brown fox jumps over the lazy dog";

		foreach ($this->stringFunctions as $function) {
			$r = call_user_func_array($function, array($string));
		}
	}

	public function test_Loops($ci) {
		$i = 0; while($i < 10000) ++$i;
		for($i = 0; $i < 10000; ++$i);
	}


	public function test_IfElse($ci) {
		if ($ci == -1) {
		} elseif ($ci == -2) {
		} else if ($ci == -3) {
		}
	}	


}