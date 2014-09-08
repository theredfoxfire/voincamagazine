<?php
namespace Vm\VmBundle\Utils;

class Vms
{
	static public function slugify($text)
	{
		$text = preg_replace('/\W+/', '-',$text);
		$text = strtolower(trim($text, '-'));
		return $text;
	}
	static public function chunk($input, $length, $ellipses = true)
	{
		if (strlen($input) <= $length) {
			return $input;
		}

    // find last space within length
		$last_space = strrpos(substr($input, 0, $length), ' ');
		if ($last_space === FALSE) {
			$last_space = $length;
		}

		$trimmed_text = substr($input, 0, $last_space);

    // add ellipses
		if ($ellipses) {
			$trimmed_text .= '...';
		}

		return $trimmed_text;
	}
}
