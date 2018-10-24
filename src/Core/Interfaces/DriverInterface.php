<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 21:09
	 */

	namespace Xirion\Database\Core\Interfaces;

	/**
	 * Interface DriverInterface
	 *
	 * @package Xirion\Database\Core\Interfaces
	 */
	interface DriverInterface
	{
		/**
		 * DriverInterface constructor.
		 *
		 * @param array $db
		 */
		public function __construct(array $db);

		/**
		 * @param string $component
		 *
		 * @return mixed
		 */
		public function loadComponent(string $component);

		/**
		 * @param array $db
		 *
		 * @return mixed
		 */
		public function getDb(array $db);
	}