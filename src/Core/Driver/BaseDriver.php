<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 17/10/18
	 * Time: 12:40
	 */

	namespace Xirion\Database\Core\Driver;


	use Xirion\Database\Core\Interfaces\DriverInterface;

	/**
	 * Class BaseDriver
	 *
	 * @package Xirion\Database\Core\Driver
	 */
	abstract class BaseDriver implements DriverInterface
	{

		/**
		 * BaseDriver constructor.
		 *
		 * @param array $db
		 */
		abstract function __construct(array $db);

		/**
		 * @param string $component
		 *
		 * @return mixed
		 */
		abstract function loadComponent(string $component);

		/**
		 * @param array $db
		 *
		 * @return mixed
		 */
		abstract function getDb(array $db);
	}