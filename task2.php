<?php
class MaximumUniqueSubstring
{
  public function findMaximumUniqueSubstring($str) {
  	$substr = '';
    $startIndex = 0;
    $endOfStr = false;
    while (!$endOfStr) {
    	$temp = '';
    	// find substring containeng unique symbols
    	for ($i = $startIndex; strpos($temp, $str[$i]) === false && !$endOfStr; $i++) {
    		if ($i == strlen($str) - 1) {
    			$endOfStr = true;
    		}
    		$temp .= $str[$i];
    	}
    	// ++startIndex
    	$startIndex += strpos($temp, $str[$i]) + 1;
    	// 
    	if (strlen($temp) >= strlen($substr))
    		$substr = $temp;
    }
    return $substr;
  }
}

if($argc > 1) {
	echo 'result: '.MaximumUniqueSubstring::findMaximumUniqueSubstring($argv[1]).PHP_EOL;
}
else {
	echo "Error. Parameters count less than 2\n";
}
