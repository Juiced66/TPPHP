<?php

namespace App\Repositories;

use Exception;
use PDO;

use App\Models\Model;
use App\PdoDatabase;

abstract class Repository
{
	protected PDO $pdo;

	abstract public function getTable(): string;
	abstract public function findAll(): array;
	abstract public function findById( int $id ): ?Model;

	public function __construct()
	{
		$this->pdo = PdoDatabase::getPdo();
	}

	/* --- CRUD --- */

	/**
	 * CRUD: Read sur tous les éléments
	 * @return array
	 */
	protected function readAll( string $model_class, array $query_addons = [], array $addon_data = [] ): array
	{
		$result = [];

		$q = 'SELECT * FROM '. $this->getTable();
		if( !empty( $query_addons ) ) {
			$q .= ' ' . implode( ' ', $query_addons );
		}

		$stmt = $this->pdo->prepare( $q );

		if( !$stmt ) {
			throw new Exception( 'Une erreur s\'est produite' );
		}
		else {
			$stmt->execute( $addon_data );

			while( $data = $stmt->fetch() ) {
				// new $class_name() instancie une classe dont le nom est contenu dans $class_name
				array_push( $result, new $model_class( $data ) );
			}
		}

		return $result;
	}

	protected function readById( string $model_class, int $id ): ?Model
	{
		$result = null;

		$q = 'SELECT * FROM '. $this->getTable() .' WHERE id=:id';

		$stmt = $this->pdo->prepare( $q );

		if( $stmt ) {
			$stmt->execute([ 'id' => $id ]);

			$data = $stmt->fetch();

			// $stmt->errorInfo()[1] est null si il n'y pas d'erreur, sinon contient le code de l'erreur
			if( !is_null( $stmt->errorInfo()[1] ) ) {
				throw new Exception( 'Une erreur s\'est produite' );
			}
			// $data est false si il n'y a pas de résultat
			else if( !empty( $data ) ) {
				$result = new $model_class( $data );
			}
		}

		return $result;
	}
}