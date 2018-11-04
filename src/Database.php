<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 19:59
	 */

	namespace Xirion\Database;

	use Xirion\DependencyInjector\Container;
	use Xirion\DependencyInjector\Factory;

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
		 * @var Container
		 */
		private $_container;
		/**
		 * @var
		 */
		public static $instance;

		/**
		 * @param array $db
		 *
		 * @return Database
		 */
		public static function getInstance()
		{
			if (is_null(self::$instance)) {
				self::$instance = new Database();
			}

			return self::$instance;
		}

		/**
		 * Database constructor.
		 *
		 * @param array $db
		 */
		public function __construct()
		{
			$this->_container = Container::getInstance();
		}


		/**
		 * @param string $name
		 *
		 * @return mixed|object
		 * @throws \ReflectionException
		 * @throws \Xirion\Bags\Exceptions\BagException
		 * @throws \Xirion\Bags\Exceptions\BagNotFoundException
		 */
		public function getDriver(string $name)
		{
			return $this->_container->attachRule($this->_drivers[$name]['driver'],
				Factory::makeRule(true, false,	['db' => $this->_drivers[$name]['db']]))
				->getClass($this->_drivers[$name]['driver']);
		}

		/**
		 * @param string $name
		 * @param        $driver
		 */
		public function addDriver(string $name, string $driver, array $db)
		{
			if ($this->driverExists($name) === false) {
				$this->_drivers[$name] = array(
					'driver' => $driver,
					'db' => $db
				);
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