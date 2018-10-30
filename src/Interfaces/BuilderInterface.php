<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 12/10/18
	 * Time: 20:04
	 */

	namespace Xirion\Database\Interfaces;


	/**
	 * Interface BuilderInterface
	 *
	 * @package Xirion\Database\Base\Interfaces
	 */
	interface BuilderInterface
	{
		/*
		 * DQL Part
		 */

		/**
		 * @param string $table
		 *
		 * @return mixed
		 */
		public function table(string $table);

		/**
		 * @param null $field
		 *
		 * @return mixed
		 */
		public function select($field = null);

		/**
		 * @param array $columns
		 * @param array $values
		 *
		 * @return mixed
		 */
		public function insert(array $columns, array $values);

		/**
		 * @param array $columns
		 * @param array $params
		 *
		 * @return mixed
		 */
		public function update(array $columns, array $params);

		/**
		 * @return mixed
		 */
		public function delete();

		/**
		 * @param       $condition
		 * @param array $params
		 *
		 * @return mixed
		 */
		public function where($condition, array $params);

		/**
		 * @param string $column
		 * @param string $order
		 *
		 * @return mixed
		 */
		public function order(string $column, string $order);

		/**
		 * @param null $one
		 *
		 * @return mixed
		 */
		public function loadObject($one = null);

		/*
		 * DLL Part
		 */

		/**
		 * @param string $database
		 *
		 * @return mixed
		 */
		public function createDatabase(string $database);

		/**
		 * @param string $database
		 *
		 * @return mixed
		 */
		public function deleteDatabase(string $database);

		/**
		 * @param string $table
		 * @param string $columns
		 * @param        $types
		 *
		 * @return mixed
		 */
		public function createTable(string $table, string $columns, string $types);

		/**
		 * @param string $table
		 *
		 * @return mixed
		 */
		public function deleteTable(string $table);

		/**
		 * @param string $table
		 * @param string $column
		 * @param string $type
		 *
		 * @return mixed
		 */
		public function createColumn(
			string $table,
			string $column,
			string $type
		);

		/**
		 * @param string $table
		 * @param string $column
		 *
		 * @return mixed
		 */
		public function deleteColumn(string $table, string $column);


		/*
		 * General part
		 */

		/**
		 * @param string     $sql
		 * @param array|null $params
		 *
		 * @return mixed
		 */
		public function make(string $sql, array $params = null);

		/**
		 * @return mixed
		 */
		public function executeQuery();

	}