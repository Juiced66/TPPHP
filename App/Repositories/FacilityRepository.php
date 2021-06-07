<?php

namespace App\Repositories;

use Exception;

use App\Models\Facility;

class FacilityRepository extends Repository
{
	public function getTable(): string
	{
		return 'Facility';
	}
	public function getColumns(): array
	{
		return [ 'name_facility'];
	}

	public function findAll( array $query_addons = [], array $addon_data = [] ): array
	{
		return $this->readAll( Facility::class, $query_addons, $addon_data );
	}

	public function findById( int $id ): ?Facility
	{
		return $this->readById( Facility::class, $id );
	}


}
