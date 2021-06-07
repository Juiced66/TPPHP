<?php

namespace App\Repositories;

use Exception;
use PDO;
use PDOException;

use App\Models\Model;
use App\PdoDatabase;

abstract class Repository
{
	protected PDO $pdo;

	abstract public function getColumns(): array;
	abstract public function getTable(): string;
	abstract public function findAll(): array;
	abstract public function findById( int $id ): ?Model;

	public function __construct()
	{
		$this->pdo = PdoDatabase::getPdo();
	}

	/* --- CRUD --- */

	/**
	 * Crud: Create
	 * @param Model $model
	 * @return Model
	 */
	public function create( Model $model ): Model
	{
		// ex: INSERT INTO `cars` (`color`,`title`,`desc`) VALUES (:color,:title,:desc)
		$q = sprintf(
			'INSERT INTO `%s` (%s) VALUES (%s)',
			$this->getTable(),
			$this->getQueryColumnsList(),
			$this->getQueryValuesList()
		);

		$stmt = $this->pdo->prepare( $q );
		$stmt->execute( $this->getQueryBindings( $model ) );

		if( $stmt->errorCode() != PDO::ERR_NONE ) {
			throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
		}

		$model->id = $this->pdo->lastInsertId();

		return $model;
	}

	/**
	 * cRud: Read - All
	 * @param string $model_class Full qualified model class name
	 * @param array $query_addons Query addons such as JOINs, and WHERE clauses
	 * @param array $addon_data Data for addons
	 *
	 * @return array
	 * @throws Exception
	 */
	protected function readAll( string $model_class, array $query_addons = [], array $addon_data = [] ): array
	{
		$result = [];

		$q = 'SELECT * FROM '. $this->getTable();
		if( !empty( $query_addons ) ) {
			$q .= ' ' . implode( ' ', $query_addons );
		}
		$stmt = $this->pdo->prepare( $q );

		$stmt->execute( $addon_data );

		if( $stmt->errorCode() != PDO::ERR_NONE ) {
			throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
		}

		while( $data = $stmt->fetch() ) {
			// new $class_name() instancie une classe dont le nom est contenu dans $class_name
			array_push( $result, new $model_class( $data ) );
		}

		return $result;
	}

	/**
	 * cRud: Single by id
	 * @param string $model_class Full qualified model class name
	 * @param int $id ID ton retrieve
	 *
	 * @return Model|null Instance of the model or null if not found
	 * @throws Exception
	 */
	protected function readById( string $model_class, int $id ): ?Model
	{
		$result = null;

		$q = 'SELECT * FROM '. $this->getTable() .' WHERE `id`=:id';

		$stmt = $this->pdo->prepare( $q );

		$stmt->execute([ 'id' => $id ]);

		if( $stmt->errorCode() != PDO::ERR_NONE ) {
			throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
		}

		$data = $stmt->fetch();

		if( !empty( $data ) ) {
			$result = new $model_class( $data );
		}

		return $result;
	}

	/**
	 * crUd: Update
	 * @param Model $model
	 * @return Model
	 */
	public function update( Model $model ): Model
	{
		$fields = [];

		foreach( $this->getColumns() as $column ) {
			// sprintf('`%s`=:%s', $column, $column);
			$field = sprintf( '`%1$s` = :%1$s', $column );
			array_push( $fields, $field );
		}

		// UPDATE `cars` SET `color`=:color,`title`=:title,`desc`=:desc WHERE `id`=:id
		$q = sprintf(
			'UPDATE `%s` SET %s WHERE `id`=:id',
			$this->getTable(),
			implode( ',', $fields )
		);

		$stmt = $this->pdo->prepare( $q );

		$bindings = $this->getQueryBindings( $model );
		$bindings['id'] = $model->id;

		$stmt->execute( $bindings );

		if( $stmt->errorCode() != PDO::ERR_NONE ) {
			throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
		}

		return $model;
	}

	/**
	 * cruD: Delete
	 * @param int $id
	 * @return void
	 */
	public function delete( int $id ): void
	{
		$q = sprintf(
			'DELETE FROM `%s` WHERE `id`=:id',
			$this->getTable()
		);

		$stmt = $this->pdo->prepare( $q );

		$stmt->execute( [ 'id' => $id ] );

		if( $stmt->errorCode() != PDO::ERR_NONE ) {
			throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
		}
	}


	protected function getQueryBindings( Model $model ): array
	{
		$bindings = [];

		foreach( $this->getColumns() as $column ) {
			if( property_exists( $model, $column ) ) {
				// "??": "Null Coalesce operator"
				$bindings[$column] = $model->$column ?? null ; // equiv: isset( $model->$column ) ? $model->column : null
			}
		}

		/*
		[
			'color' => 'white',
			'title' => 'Ma supercar',
			'desc' => 'look at me'
		]
		*/
		return $bindings;
	}

	protected function getQueryColumnsList(): string
	{
		return implode( ',', array_map( function( $item ) { return '`'. $item .'`'; }, $this->getColumns() ) );
	}

	protected function getQueryValuesList(): string
	{
		return implode( ',', array_map( function( $item ) { return ':'. $item; }, $this->getColumns() ) );
	}
}
