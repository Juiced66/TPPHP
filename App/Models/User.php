<?php

/**
 * Class User
 */

namespace App\Models;

class User extends Model
{
    public const ROLE_ANNOUNCER = 0;
    public const ROLE_RENTER = 1;
    
    public string $email;
    public string $username;
    public string $password;
    public int $role;

    public static function hashPassword( string $password ): string
	{
		return hash('sha512', HASH_SALT.$password.HASH_PEPPER );
	}

    public static function isAuth(): bool
    {
        return isset($_SESSION['USER']);
    }
    public static function fromSession(): ?self
    {
        if (!self::isAuth()) {
            return null;
        }
        return $_SESSION['USER'];
    }
    public static function isRenter(): bool
    {
        if (
            !self::isAuth()
        ) {
            return false;
        }
        $user = self::fromSession();
        return $user->role === self::ROLE_RENTER;
    }
    public static function isAnnouncer(): bool
    {
        if (
            !self::isAuth()
        ) {
            return false;
        }
        $user = self::fromSession();
        return $user->role === self::ROLE_ANNOUNCER;
    }
    public function getRoleName(): string
    {
        $role_name = '';

        switch( $this->role ) {
            case self::ROLE_ANNOUNCER:
                $role_name = 'Annonceur';
                break;

            case self::ROLE_RENTER:
                $role_name = 'Locataire';
                break;


            default:
                $role_name = 'Hacker';
                break;
        }

        return $role_name;
    }

}