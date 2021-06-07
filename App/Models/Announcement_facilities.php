<?php
/**
 * Class Announcement_facilities
 */

namespace App\Models;

use App\Repositories\RepositoryManager;


class Announcement_facilities extends Model
{
	public int $announcement_id;
	public int $facility_id;

    protected Announcement $_announcement;
	protected function announcement(): Announcement
	{
		if( !isset( $this->_announcement ) ) {
			$this->_announcement = RepositoryManager::getRm()->getAnnouncementRepository()->findById( $this->announcement_id );
		}

		return $this->_announcement;
	}

    protected Facility $_facility;
	protected function facility(): Facility
	{
		if( !isset( $this->_facility ) ) {
			$this->_facility = RepositoryManager::getRm()->getFacilityRepository()->findById( $this->facility_id );
		}

		return $this->_facility;
	}
}