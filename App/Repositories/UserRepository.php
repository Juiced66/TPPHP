<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
	public function getTable(): string
	{
		return 'users';
	}

	public function findAll(): array
	{
		return $this->readAll( User::class );
	}

	public function findById( int $id ): ?User
	{
		return $this->readById( User::class, $id );
	}
}