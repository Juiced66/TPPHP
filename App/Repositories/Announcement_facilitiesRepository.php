<?php

namespace App\Repositories;

use Exception;

use App\Models\Announcement_facilities;

class Announcement_facilitiesRepository extends Repository
{
	public function getTable(): string
	{
		return 'Announcement_facilities';
	}

    public function getColumns(): array
	{
		return [ 'id_announcement','id_facility'];
	}

	public function findAll( array $query_addons = [], array $addon_data = [] ): array
	{
		return $this->readAll( Announcement_facilities::class, $query_addons, $addon_data );
	}

	public function findById( int $id ): ?Announcement_facilities
	{
		return $this->readById( Announcement_facilities::class, $id );
	}
}