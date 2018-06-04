<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core\system\libraries\plugins;

use \VanilleNameSpace\core\system\libraries\Wordpress;

class ContactForm7 extends Wordpress
{
	/**
	 * Action when mail is sent
	 *
	 * @package Contactform7 4.9.2
	 * @since 4.0
	 * @category Plugin
	 * @param $form
	 * @return mixed
	 *
	 * action : wpcf7_mail_sent
	 */
	public function mailSent($form)
	{
		// ...
	}

	/**
	 * Action when mail is failed
	 *
	 * target action : wpcf7_mail_failed
	 *
	 * @package Contactform7 4.9.2
	 * @since 4.0
	 * @category Plugin
	 * @param $form
	 * @return mixed
	 */
	public function mailFailed($form)
	{
		// ...
	}

	/**
	 * Action before mail sending
	 *
	 * action : wpcf7_before_send_mail
	 *
	 * @package Contactform7 4.9.2
	 * @since 4.0
	 * @category Plugin
	 * @param $form
	 * @return mixed
	 */
	public function beforeSend($form)
	{
		// ...
	}

	/**
	 * Action on form submit
	 *
	 * @package Contactform7 4.9.2
	 * @since 4.0
	 * @category Plugin
	 * @param contact_form
	 * @return mixed
	 *
	 * action : wpcf7_submit
	 */
	public function formSubmit($instance, $result)
	{
	    // ...
	}

	/**
	 * Custom postal validation for Contactform7
	 *
	 * @package Contactform7 4.9.2
	 * @since 4.0
	 * @category Plugin
	 * @param $spam
	 * @return mixed
	 *
	 * filter : wpcf7_spam
	 */
	public function isSpam($spam)
	{
	    // ...
	}

	/**
	 * Custom warning for Contactform7
	 *
	 * @package Contactform7 4.9.2
	 * @since 4.0
	 * @category Plugin
	 * @param void
	 * @return mixed
	 *
	 * filter : wpcf7_admin_warnings
	 * default : 10, 0
	 */
	public function setWarning()
	{
		// ...
	}

	/**
	 * Custom postal validation for Contactform7
	 *
	 * @package Contactform7 4.9.2
	 * @since 4.0
	 * @category Plugin
	 * @param $spam
	 * @return boolean
	 */
	protected function isValidePhone($phone)
	{
		$pattern = '/^((\+\(?33\)?)|(0033)|0)[\.\s]*\d([\.\s]*\d{2}){4}$/';
		if (preg_match($pattern, $phone)) return true;
	}

	/**
	 * Contact form 7 helper | Viaprestige
	 *
	 * @param string|int $postal
	 * @return boolean
	 */
	protected function isValidePostal($postal)
	{
		$pattern = '/^((0[1-9])|([1-8]\d)|(9[0-8])|(2A)|(2B))\d{3}$/';
		if (preg_match($pattern, $phone)) return true;
	}
}
