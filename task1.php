<?php
class Brackets
{
	public function isBracketSequenceCorrect($str) {
		$openingBrackets = ['(','{','['];
		$closingBrackets = [')','}',']'];
		$stack = [];
		for ($i = 0; $i < strlen($str); $i++) {
			if (in_array($str[$i],$openingBrackets)) {
				/*
				* all the opening brackets are written to the stack
				*/
				array_push($stack, $str[$i]);
			}
			if (in_array($str[$i],$closingBrackets)) {
				/*
				* if the current closing bracket matches the last open bracket extracted 
				* from the stack, the sequence of brackets is correct at the moment, 
				* otherwise the sequence of brackets is incorrect
				*/
				$lastBracket = array_pop($stack);
				if($lastBracket == NULL) 
					return false;
				foreach ($openingBrackets as $key=>$ob) {
					if ($ob == $lastBracket && $str[$i] != $closingBrackets[$key]) {
						return false;
					} 
				}
			}
		}
		if (count($stack) > 0) 
			return false;

		return true;
	}
}


if($argc > 1) {
	if(Brackets::isBracketSequenceCorrect($argv[1]))
		echo 'correct'.PHP_EOL;
	else
		echo 'incorrect'.PHP_EOL;
}
else {
	echo "Error. Parameters count less than 2\n";
}
