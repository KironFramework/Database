<?php

	/**
	 * Created by PhpStorm.
	 * User: NielsTRS
	 * Date: 16/10/18
	 * Time: 19:54
	 */

	namespace Xirion\Database\Core\Driver\Components;


	use Xirion\Database\Core\Exceptions\DatabaseException;
	use Xirion\Database\Core\Interfaces\BuilderInterface;
	use \PDO;

	/**
	 * Class BaseBuilder
	 *
	 * @package Xirion\Database\Core\Driver\Components
	 */
	abstract class BaseBuilder implements BuilderInterface
	{
		/**
		 * @var PDO
		 */
		protected $_pdo;
		/**
		 * @var
		 */
		protected $_table;
		/**
		 * @var
		 */
		protected $_query;
		/**
		 * @var array
		 */
		protected $_params = [];
		/**
		 * @var
		 */
		protected $_executedQuery;

		/**
		 * BaseBuilder constructor.
		 *
		 * @param PDO $pdo
		 */
		public function __construct(PDO $pdo)
		{
			$this->_pdo = $pdo;
		}

		/*
		 * DQL Part
		 */

		/**
		 * @param string $table
		 *
		 * @return $this|mixed
		 */
		public function table(string $table)
		{
			$this->_table = $table;
			return $this;
		}

		/**
		 * @param null $field
		 *
		 * @return $this|mixed
		 */
		public function select($field = null)
		{
			if (is_null($field)) {
				$field = '*';
			}
			$this->_query .= ' SELECT ' . $field . ' FROM '
				. $this->_table;
			return $this;
		}

		/**
		 * @param array $columns
		 * @param array $values
		 *
		 * @return $this|mixed
		 * @throws DatabaseException
		 */
		public function insert(array $columns, array $values)
		{
			$nb_columns = count($columns);
			$nb_values = count($values);
			$str = '';
			if ($nb_columns === $nb_values) {
				for ($i = 0; $i < $nb_values; $i++) {
					if ($i === 0) {
						$str .= ' ? ';
					} else {
						$str .= ' , ? ';
					}
				}
				$this->_query .= ' INSERT INTO ' . $this->_table;
				$this->_query .= ' ( ' . implode(', ', $columns) . ' ) VALUES ';
				$this->_query .= ' ( ' . $str . ' ) ';
				$this->_params = array_merge($this->_params, $values);
				return $this;
			} else {
				throw new DatabaseException("You must have the same number of parameters");
			}
		}

		/**
		 * @param array $columns
		 * @param array $params
		 *
		 * @return $this|mixed
		 * @throws DatabaseException
		 */
		public function update(array $columns, array $params)
		{
			$nb_columns = count($columns);
			$nb_values = count($params);
			$i = 0;
			$str = '';
			if ($nb_columns === $nb_values) {
				$this->_query .= ' UPDATE ' . $this->_table . ' SET ';
				foreach ($columns as $column) {
					$i++;
					if ($i === $nb_columns) {
						$str .= $column . ' = ? ';
					} else {
						$str .= $column . ' = ? , ';
					}
				}
				$this->_query .= $str;
				$this->_params = array_merge($this->_params, $params);
				return $this;
			} else {
				throw new DatabaseException("You must have the same number of parameters");
			}
		}

		/**
		 * @return $this|mixed
		 */
		public function delete()
		{
			$this->_query .= ' DELETE FROM ' . $this->_table;
			return $this;
		}

		/**
		 * @param       $condition
		 * @param array $params
		 *
		 * @return $this|mixed
		 */
		public function where($condition, array $params)
		{
			$this->_query .= ' WHERE ' . $condition;
			$this->_params = array_merge($this->_params, $params);
			return $this;
		}

		/**
		 * @param string $column
		 * @param string $order
		 *
		 * @return $this|mixed
		 */
		public function order(string $column, string $order)
		{
			$this->_query .= ' ORDER BY ' . $column . ' ' . $order;
			return $this;
		}

		/**
		 * @param null $one
		 *
		 * @return mixed
		 */
		public function loadObject($one = null)
		{
			if (isset($one)) {
				return $this->_executedQuery->fetch(PDO::FETCH_OBJ);
			} else {
				return $this->_executedQuery->fetchAll(PDO::FETCH_OBJ);
			}
		}

		/*
		 * DDL Part
		 */

		/**
		 * @param string $database
		 *
		 * @return mixed|void
		 */
		public function createDatabase(string $database)
		{
			$this->_query = 'CREATE DATABASE ' . $database;
		}

		/**
		 * @param string $database
		 *
		 * @return mixed|void
		 */
		public function deleteDatabase(string $database)
		{
			$this->_query = 'DROP DATABASE ' . $database;
		}

		/**
		 * @param string $table
		 * @param string $columns
		 * @param string $types
		 *
		 * @return mixed|void
		 * @throws DatabaseException
		 */
		public function createTable(string $table, string $columns, string $types)
		{
			$nb_columns = count($columns);
			$nb_types = count($types);
			$str = '';
			$i = 0;
			if ($nb_columns === $nb_types) {
				foreach ($columns as $column) {
					foreach ($types as $type) {
						$i++;
						if ($i === $nb_columns) {
							$str .= $column . $type;
						} else {
							$str .= $column . $type . ', ';
						}
					}
				}
				$this->_query = 'CREATE TABLE ' . $table . ' ( ' . $str . ' ) ';
			} else {
				throw new DatabaseException("You must have the same number of parameters");
			}
		}

		/**
		 * @param string $table
		 *
		 * @return mixed|void
		 */
		public function deleteTable(string $table)
		{
			$this->_query = 'DROP TABLE ' . $table;
		}

		/**
		 * @param string $table
		 * @param string $column
		 * @param string $type
		 *
		 * @return mixed|void
		 */
		public function createColumn(string $table, string $column, string $type)
		{
			$this->_query = 'ALTER TABLE ' . $table . ' ADD ' . $column . ' '
				. $type;
		}

		/**
		 * @param string $table
		 * @param string $column
		 *
		 * @return mixed|void
		 */
		public function deleteColumn(string $table, string $column)
		{
			$this->_query = 'ALTER TABLE ' . $table . ' DROP COLUMN ' . $column;
		}

		/*
		 * General Part
		 */

		/**
		 * @param string     $sql
		 * @param array|null $params
		 *
		 * @return mixed|void
		 */
		public function make(string $sql, array $params = null)
		{
			$this->_query = $sql;
			$this->_params = $params;
		}

		/**
		 * @return $this|mixed
		 */
		public function executeQuery()
		{
			$query = $this->_pdo->prepare($this->_query);
			$query->execute($this->_params);
			$this->_executedQuery = $query;
			return $this;
		}
	}