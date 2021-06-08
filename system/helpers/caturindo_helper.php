<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function random_string($type = 'alnum', $len = 8)
{
	switch ($type)
	{
		case 'basic':
			return mt_rand();
		case 'alnum':
		case 'numeric':
		case 'nozero':
		case 'alpha':
			switch ($type)
			{
				case 'alpha':
					$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					break;
				case 'alnum':
					$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					break;
				case 'numeric':
					$pool = '0123456789';
					break;
				case 'nozero':
					$pool = '123456789';
					break;
			}
			return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
		case 'unique': // todo: remove in 3.1+
		case 'md5':
			return md5(uniqid(mt_rand()));
		case 'encrypt': // todo: remove in 3.1+
		case 'sha1':
			return sha1(uniqid(mt_rand(), TRUE));
	}
}

/* End of file caturindo_helper.php */
/* Location: .//C/xampp-portable/htdocs/INDITAMA/caturindo_api/system/helpers/caturindo_helper.php */