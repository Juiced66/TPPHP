<?php

/**
 * Class Model
 */


namespace App\Models;

use Exception;

abstract class Model
{
    public int $id;

    public function __construct( array $db_data = [] )
    {
        foreach( $db_data as $column_name => $data_value ) {
            if( property_exists( $this, $column_name ) ) {
                $this->$column_name = $data_value;
            }
        }
    }

	public function __get( $name )
	{
		if( method_exists( $this, $name ) ) {
			return $this->$name();
		}

		throw new Exception('Invalid property "' . $name . '"' );
	}
}
