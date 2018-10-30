<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 20:03
	 */

	namespace Xirion\Database\Drivers\Mysql\Components;

	use PDO;
	use Xirion\Database\Drivers\Base\BaseBuilder;

	/**
	 * Class Builder
	 *
	 * @package Xirion\Database\Drivers\Mysql\Components
	 */
	class Builder extends BaseBuilder
	{
		public function __construct(PDO $pdo)
		{
			parent::__construct($pdo);
		}

	}