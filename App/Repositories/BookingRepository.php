<?php

namespace App\Repositories;
use PDO;
use PDOException;
use Exception;

use App\Models\Booking;

class BookingRepository extends Repository
{
	public function getTable(): string
	{
		return 'Booking';
	}
	public function getColumns(): array
	{
		return [ 'begin_at','end_at','user_id','announcement_id'];
	}

	public function findAll( array $query_addons = [], array $addon_data = [] ): array
	{
		return $this->readAll( Booking::class, $query_addons, $addon_data );
	}

	public function findById( int $id ): ?Booking
	{
		return $this->readById( Booking::class, $id );
	}
	public function findRenterBookings(string $query_addons) :array{
		$q= 
		'SELECT b.begin_at début ,b.end_at fin , u.username propriétaire 
			FROM lamp.Booking as b 
			JOIN Announcement as a ON announcement_id = a.id 
			JOIN `User` AS u ON u.id = a.owner_id'
		;
		$result = [];

		$q .= $query_addons;
		

		$stmt = $this->pdo->prepare( $q );

		$stmt->execute( );

		if( $stmt->errorCode() != PDO::ERR_NONE ) {
			throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
		}

		while( $data = $stmt->fetch() ) {
			// new $class_name() instancie une classe dont le nom est contenu dans $class_name
			array_push( $result,  $data  );
		}

		return $result;
	}
	public function findAnnouncerBookings(string $query_addons) :array{
		
		$q= 
		'SELECT b.begin_at début ,b.end_at fin , u.username locataire 
			FROM lamp.Booking as b 
			JOIN Announcement as a ON announcement_id = a.id 
			JOIN `User` AS u ON u.id = b.user_id';
	
		$result = [];
		$q .= $query_addons;
		

		$stmt = $this->pdo->prepare( $q );

		$stmt->execute( );

		if( $stmt->errorCode() != PDO::ERR_NONE ) {
			throw new PDOException( $stmt->errorInfo()[2], $stmt->errorInfo()[1] );
		}

		while( $data = $stmt->fetch() ) {
			// new $class_name() instancie une classe dont le nom est contenu dans $class_name
			array_push( $result,  $data  );
		}

		return $result;
	}
}