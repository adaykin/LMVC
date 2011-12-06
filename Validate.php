<?php

/**
 * Performs regular expression validation on a number of commonly used input types.
 *
 * @author	   Andy Daykin    
 * @copyright  Copyright (c) 2009 Andy Daykin
 * @license    MIT http://www.opensource.org/licenses/mit-license.php
 * @version    0.1
 * @link       http://trac.andydaykin.com/browser/Validate.php
 * @package    LMVC\Validate
 */

namespace LMVC;

class Validate
{
	/**
	 * Validates a US zip code with the format 5 digits, or 5 digits a dash, and the
	 * next 4 digits.
	 * 
	 * @param string $zip
	 * @return boolean
	 */
	public function zip($zip)
	{
		return preg_match('/\d{5}(-\d{5})?/', $zip);
	}
	
	/**
	 * Validates a US phone number with an area code and number with dots, white
	 * space, or dashes between the numbers, and parenthesis around the area code.
	 * 
	 * @param string $phone
	 * @return boolean
	 */
	public function phone($phone)
	{
		return preg_match('/\(?\d{3}\)?[-\.\s]*\d{3}[-\.\s]*\d{4}/', $phone);
	}
	
	/**
	 * Validates an email according to RFC __.
	 * 
	 * @param string $email
	 */
	public function email($email)
	{
        $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
        $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
        $atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
            '\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
        $quoted_pair = '\\x5c[\\x00-\\x7f]';
        $domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";
        $quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";
        $domain_ref = $atom;
        $sub_domain = "($domain_ref|$domain_literal)";
        $word = "($atom|$quoted_string)";
        $domain = "$sub_domain(\\x2e$sub_domain)*";
        $local_part = "$word(\\x2e$word)*";
        $addr_spec = "$local_part\\x40$domain";
        return preg_match("!^$addr_spec$!", $email);
	}
	
	/**
	 * 
	 * @param string $cc
	 * @param string $type
	 * @return boolean
	 */
	public function cc($cc, $type = NULL)
	{
		switch($type) {
			case "American":
				return preg_match('/^([34|37]{2})(\d{13})$/', $cc);
			break;
			case "Dinners":
				return preg_match('/^([30|36|38]{2})(\d{12})$/', $cc);
			break;		
			case "Discover":
				return preg_match('/^([6011]{4})(\d{12})$/', $cc);
			break;
			case "Master":
				return preg_match('/^([51|52|53|54|55]{2})(\d{14})$/', $cc);
			break;
			case "Visa":
				return preg_match('/^4(\d{12,15})$/', $cc);
			break;
			default:
				return preg_match('^(?:4[0-9]{12}(?:\d{3})?|5[1-5]\d{14}|6011\d{12}|3(?:0[0-5]|[68]\d)\d{11}|3[47]\d{13})$', $cc);			
			break;
		}
	}
	
	/**
	 * 
	 * @param string $barcode
	 * @return boolean
	 */
	public function barcode($barcode)
	{
		
	}
	
	/**
	 * Validates a US social security number with the format 3 digits, 2 digits, and
	 * 4 digits, with optional dashes between the set of numbers.
	 * 
	 * @param string $ssn
	 * @return boolean
	 */
	public function ssn($ssn)
	{
		return preg_match('^\d{3}-?\d{2}-?\d{4}$', $ssn);
	}
}