<?php

/**
 * Calculate a bank belgian structured communication from 10 digits number.
 *
 * @param string 	$number a 10 digits number
 * @param boolean $format format like +++ 123 / 1234 / 12345 +++
 *
 * @return string
 */
function get_structured_communication_from_number($number, $format = TRUE)
{
	// sanitize
	$number = preg_replace('/[^0-9]/', '', $number);

	// ensure number of requested numbers is correct
	if( isset($number[10]) || ! isset($number[9]) )
	{
		throw new \Exception("Parameter must be a 10 digits number.", 1);
	}

	// calculate control number
	$control_number = $number % 97;

	// Control number must be 2 digits (faster than sprintf)
	if($control_number < 10)
	{
		$control_number = '0' . $control_number;
	}

	// Control number cannot be 00
	if($control_number === '00')
	{
		$control_number = '97';
	}

	// concatenate number and control number
	$string = $number . $control_number;

	// return result
	if($format === TRUE)
	{
		return '+++ ' . substr($string, 0, 3) . ' / ' . substr($string, 3, 4) . ' / ' . substr($string, 7, 5) . ' +++';
	}
	else
	{
		return $string;
	}
}

 ?>
