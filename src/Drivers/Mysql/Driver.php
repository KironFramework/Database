<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 21:07
	 */

	namespace Xirion\Database\Drivers\Mysql;

	use \PDO;
	use Xirion\Database\Core\Driver\BaseDriver;
	use Xirion\Database\Core\Exceptions\DatabaseException;

	/**
	 * Class Driver
	 *
	 * @package Xirion\Database\Drivers\Mysql
	 */
	class Driver extends BaseDriver
	{

		/**
		 * @var
		 */
		private $_pdo;

		/**
		 * Driver constructor.
		 *
		 * @param array $db
		 */
		public function __construct(array $db)
		{
			$this->getDb($db);
		}

		/**
		 * @param string $component
		 *
		 * @return mixed
		 * @throws DatabaseException
		 */
		public function loadComponent(string $component)
		{
			$componentClass = 'Xirion\Database\Drivers\Mysql\Components\\'
				. $component;
			if (class_exists($componentClass)) {
				return new $componentClass($this->_pdo);
			} else {
				throw new DatabaseException("The component $component in the Mysql driver doesn't exists");
			}
		}

		/**
		 * @param array $db
		 */
		public function getDb(array $db)
		{
			$this->_pdo = new PDO('mysql:host=' . $db[0] . ';dbname=' . $db[1]
				. ';charset=' . $db[2] . '', $db[3], $db[4]);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION);
		}

	}