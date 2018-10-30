<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 19:59
	 */

	namespace Xirion\Database;

	/**
	 * Class Database
	 *
	 * @package Xirion\Database
	 */
	class Database
	{

		/**
		 * @var array
		 */
		private $_drivers = [];
		/**
		 * @var array
		 */
		private $_db = [];

		/**
		 * @var
		 */
		public static $instance;

		/**
		 * @param array $db
		 *
		 * @return Database
		 */
		public static function getInstance(array $db)
		{
			if (is_null(self::$instance)) {
				self::$instance = new Database($db);
			}

			return self::$instance;
		}

		/**
		 * Database constructor.
		 *
		 * @param array $db
		 */
		public function __construct(array $db)
		{
			$this->_db = $db;
		}

		/**
		 * @param string $name
		 *
		 * @return mixed
		 */
		public function getDriver(string $name)
		{
			return $this->_drivers[$name]::getInstance($this->_db);
		}

		/**
		 * @param string $name
		 * @param        $driver
		 */
		public function addDriver(string $name, $driver)
		{
			if ($this->driverExists($name) === false) {
				$this->_drivers[$name] = $driver;
			}
		}

		/**
		 * @param string $name
		 */
		public function deleteDriver(string $name)
		{
			if ($this->driverExists($name)) {
				unset($this->_drivers[$name]);
			}
		}

		/**
		 * @param string $name
		 *
		 * @return bool
		 */
		private function driverExists(string $name)
		{
			if (isset($this->_drivers[$name])) {
				return true;
			} else {
				return false;
			}
		}

	}