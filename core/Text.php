<?php

class Text {
	
	public static function limit($text, $maxLength)
	{
		if (strlen($text) > $maxLength) {
		
			// truncate string
			$stringCut = substr($text, 0, $maxLength);
		
			// make sure it ends in a word so assassinate doesn't become ass...
			$text = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
		}
		return $text;
	}
	
}


?>