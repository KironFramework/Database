<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 21:07
	 */

	namespace Xirion\Database\Drivers\Mysql;

	use \PDO;
	use Xirion\Database\Drivers\Mysql\Components\Builder;
	use Xirion\Database\Interfaces\DriverInterface;

	/**
	 * Class Driver
	 *
	 * @package Xirion\Database\Drivers\Mysql
	 */
	class Driver implements DriverInterface
	{

		/**
		 * @var PDO
		 */
		private $_pdo;

		/**
		 * @var
		 */
		public static $instance;

		/**
		 * @param array $db
		 *
		 * @return mixed|Driver
		 */
		public static function getInstance(array $db)
		{
			if (is_null(self::$instance)) {
				self::$instance = new Driver($db);
			}

			return self::$instance;
		}

		/**
		 * Driver constructor.
		 *
		 * @param array $db
		 */
		public function __construct(array $db)
		{
			$this->_pdo = new PDO('mysql:host=' . $db[0] . ';dbname=' . $db[1]
				. ';charset=' . $db[2] . '', $db[3], $db[4]);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION);
		}

		/**
		 * @return mixed|Builder
		 */
		public function getBuilder()
		{
			return new Builder($this->_pdo);
		}

	}