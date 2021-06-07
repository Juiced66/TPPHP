<?php

namespace App\Repositories;

use Exception;

use App\Models\Announcement;

class AnnouncementRepository extends Repository
{
	public function getTable(): string
	{
		return 'Announcement';
	}

    public function getColumns(): array
	{
		return [ 'city', 'country', 'title', 'description', 'rent_type', 'price', 'owner_id', 'nb_persons'];
	}

	public function findAll( array $query_addons = [], array $addon_data = [] ): array
	{
		return $this->readAll( Announcement::class, $query_addons, $addon_data );
	}

	public function findById( int $id ): ?Announcement
	{
		return $this->readById( Announcement::class, $id );
	}

	// protected function findAnnouncerAnnoncements( string $model_class, int $id ): ?Model
	// {
	// 	$result = null;

	// 	$q = 'SELECT * FROM lamp.Announcement WHERE a.owner_id ='.$_SESSION['USER']->id . ';';

	// 	$stmt = $this->pdo->prepare( $q );

	// 	if( $stmt->errorCode() != PDO::ERR_NONE ) {
	// 		throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
	// 	}

	// 	$data = $stmt->fetch();

	// 	if( !empty( $data ) ) {
	// 		$result = new $model_class( $data );
	// 	}

	// 	return $result;
	// }
}