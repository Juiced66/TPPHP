<?php

namespace App\Repositories;

class RepositoryManager
{
	private static ?self $instance = null;

	private UserRepository $userRepository;
	public function getUserRepository(): UserRepository { return $this->userRepository; }

	public static function getRm(): self
	{
		if( is_null(self::$instance) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->userRepository = new UserRepository();
	}

	private function __clone() { }
	private function __wakeup() { }
}