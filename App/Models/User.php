<?php

/**
 * Class User
 */

namespace App\Models;

class User extends Model
{
    public const ROLE_SUPERADMIN = 0;
    public const ROLE_ADMIN = 1;
    public const ROLE_USER = 2;
    
    public string $email;
    public string $username;
    public string $password;
    public int $role;

    public function getRoleName(): string
    {
        $role_name = '';

        switch( $this->role ) {
            case self::ROLE_SUPERADMIN:
                $role_name = 'Super-administrateur';
                break;

            case self::ROLE_ADMIN:
                $role_name = 'Administrateur';
                break;

            case self::ROLE_USER:
                $role_name = 'Utilisateur';
                break;

            default:
                $role_name = 'Hacker';
                break;
        }

        return $role_name;
    }
}