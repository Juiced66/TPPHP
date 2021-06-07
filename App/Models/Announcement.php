<?php
/**
 * Class Announcement
 */

namespace App\Models;

use App\Repositories\RepositoryManager;

class Announcement extends Model
{
    public const TYPE_FULL_HOME = 0;
    public const TYPE_COLLECTIVE_ROOM = 1;
    public const TYPE_INDIVIDUAL_ROOM = 2;
    

    public string $city;
    public string $country;
    public string $title;
    public string $description;
    public int $rent_type;
    public int $price;
    public int $nb_persons;
    public int $owner_id;

    public function getTypeName(): string
    {
        $type_name = '';

        switch( $this->rent_type ) {
            case self::TYPE_FULL_HOME:
                $type_name = 'Maison entière';
                break;

            case self::TYPE_COLLECTIVE_ROOM:
                $type_name = 'Chambre collective';
                break;
           
                case self::TYPE_INDIVIDUAL_ROOM:
                $type_name = 'Chambre individuelle';
                break;


            default:
                $type_name = 'Indeterminé';
                break;
        }

        return $type_name;
    }

    
    protected User $_owner;
	protected function owner(): User
	{
		if( !isset( $this->_owner ) ) {
			$this->_owner = RepositoryManager::getRm()->getUserRepository()->findById( $this->owner_id );
		}

		return $this->_owner;
	}

}
