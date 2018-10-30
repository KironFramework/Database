<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 21:09
	 */

	namespace Xirion\Database\Interfaces;

	/**
	 * Interface DriverInterface
	 *
	 * @package Xirion\Database\Base\Interfaces
	 */
	interface DriverInterface
	{
		/**
		 * @param array $db
		 *
		 * @return mixed
		 */
		public static function getInstance(array $db);

		/**
		 * @return mixed
		 */
		public function getBuilder();

	}