<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core\system\includes;

use \Exception;

class File
{
	/**
	 * @access public
	 */
	public $path;
	public $root;
	public $name;
	public $ext;
	public $parent;
	public $content;

	/**
	 * @access private
	 */
	private $handler;

	/**
	 * @access protected
	 */
	protected $mode;

	/**
	 * File object
	 *
	 * @param string $path, $mode
	 * @return void
	 */
	public function __construct($path = null, $mode = 'r')
	{
		$this->set($path,$mode);
		$this->isReady();
		$this->open();
	}

	/**
	 * define properties
	 *
	 * @param string $path, $mode
	 * @return void
	 */
	private function set($path, $mode)
	{
		$this->path   = $path;
		$this->mode   = $mode;
		$this->parent = dirname($this->path);
		$this->root   = realpath($this->path);
		$this->ext    = pathinfo($this->path, PATHINFO_EXTENSION);
		$this->name   = str_replace('.'.$this->ext,'',$this->path);
	}

	/**
	 * check file
	 *
	 * @param void
	 * @return boolean
	 */
	public function isReady()
	{
		if (!$this->exists())
		{
			throw new Exception('File '. $this->path .' doesn\'t exist');

		}
		elseif (!$this->readable())
		{
			throw new Exception('Error reading the file : ' . $this->path);
		}
		else
		{
			return true;
		}
	}

	/**
	 * create file
	 *
	 * @param void
	 * @return void
	 */
	protected function create()
	{
		$this->handler = fopen($this->path, 'w');
	}

	/**
	 * open file
	 *
	 * @param void
	 * @return void
	 */
	protected function open()
	{
		if ($this->exists($this->path))
		{
			$this->handler = fopen($this->path, $this->mode);
		}
	}

	/**
	 * write file
	 *
	 * @param void
	 * @return void
	 */
	public function write($input)
	{
		fwrite(fopen($this->path, 'w'), $input);
	}
	/**
	 * add string to file
	 *
	 * @param string $input
	 * @return void
	 */
	public function addString($input)
	{
		fwrite(fopen($this->path, 'a'), $input);
	}

	/**
	 * add space to file
	 *
	 * @param void
	 * @return void
	 */
	public function addSpace()
	{
		fwrite(fopen($this->path, 'a'), PHP_EOL);
	}

	/**
	 * read file
	 *
	 * @param void
	 * @return void
	 */
	public function read()
	{
		if ($this->exists($this->path) && !$this->isEmpty())
		{
			$this->content = fread($this->handler,filesize($this->path));
		}
	}

	/**
	 * close file handler
	 *
	 * @param void
	 * @return void
	 */
	public function close()
	{
		fclose($this->handler);
	}

	/**
	 * delete file object
	 *
	 * @param void
	 * @return void
	 */
	public function delete()
	{
		$this->close();
		unlink($this->path);
	}

	/**
	 * check file exists
	 *
	 * @param void
	 * @return void
	 */
	protected function exists()
	{
		if (is_file($this->path) && file_exists($this->path))
		{
			return TRUE;
		}
	}

	/**
	 * check file readable
	 *
	 * @param void
	 * @return void
	 */
	protected function readable()
	{
		if (!fopen($this->path, 'r') === FALSE) {
			return TRUE;
		}
	}

	/**
	 * check file empty
	 *
	 * @param void
	 * @return void
	 */
	public function isEmpty()
	{
		if ($this->exists($this->path))
		{
			if (filesize($this->path) == 0) {
				return TRUE;
			}
		}
	}
}
