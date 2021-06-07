<?php

namespace App\Repositories;

use App\Models\User;
use Exeption;

class UserRepository extends Repository
{
	public function getTable(): string
	{
		return 'User';
	}
	
	public function getColumns(): array
	{
		return [ 'email', 'username', 'password', 'role' ];
	}

	public function auth( string $login, string $password ): bool
	{
		$q = 'SELECT * FROM '.'`'. $this->getTable() .'`' . ' WHERE email=:email AND password=:password';
		
		$stmt = $this->pdo->prepare( $q );

		if( !$stmt ) {
			$_SESSION[ 'LOGIN_ERROR' ] = 'Une erreur s\'est produite';
			return false;
		}

		$stmt->execute([
			'email' => $login,
			'password' => User::hashPassword( $password )
		]);

		$data = $stmt->fetch();

		if( ! $data ) {
			$_SESSION[ 'LOGIN_ERROR' ] = 'Email ou mot de passe incorrect(s)';
			return false;
		}

		$user = new User( $data );

		$_SESSION[ 'USER' ] = $user;

		return true;
	}

	public function insc(string $username, string $password, string $email, int $role): bool
	{
		if (!isset($username, $password, $email, $role)) {
			return false;
		}

		$q = 'INSERT INTO `User` (`username`, `password`, `email`, `role`) ' . 'VALUES (:username, :password, :email, :role)';

		$stmt = $this->pdo->prepare($q);

		$stmt->execute([
			'username' => $username,
			'password' => User::hashPassword($password),
			'email' => $email,
			'role' => $role
		]);

		return true;
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
