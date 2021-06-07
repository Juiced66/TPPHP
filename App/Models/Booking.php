<?php
/**
 * Class Booking
 */

namespace App\Models;

class Booking extends Model
{
    public string $begin_at;
    public string $end_at;
    public int $user_id;
    public int $announcement_id;

    protected User $_user;
	protected function user(): User
	{
		if( !isset( $this->_user ) ) {
			$this->_user = RepositoryManager::getRm()->getUserRepository()->findById( $this->user_id );
		}

		return $this->_user;
	}

    protected Announcement $_announcement;
	protected function announcement(): Announcement
	{
		if( !isset( $this->_announcement ) ) {
			$this->_announcement = RepositoryManager::getRm()->getAnnouncementRepository()->findById( $this->announcement_id );
		}

		return $this->_announcement;
	}

}