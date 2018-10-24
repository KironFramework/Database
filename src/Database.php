<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 19:59
	 */

	namespace Xirion\Database;

	use Xirion\Database\Core\Exceptions\DatabaseException;

	/**
	 * Class Database
	 *
	 * @package Xirion\Database
	 */
	class Database
	{
		/**
		 * @param string $type
		 * @param array  $db
		 *
		 * @return mixed
		 * @throws DatabaseException
		 */
		public static function getDriver(string $type, array $db)
		{
			$driverClass = 'Xirion\\Database\\Drivers\\' . $type . '\Driver';
			if (class_exists($driverClass)) {
				return new $driverClass($db);
			} else {
				throw new DatabaseException("The driver $type doesn't exists");
			}
		}

	}