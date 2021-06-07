<?php

namespace App\Repositories;

class RepositoryManager
{
	private static ?self $instance = null;

	private AnnouncementRepository $announcementRepository;
	public function getAnnouncementRepository(): AnnouncementRepository
	{
		return $this->announcementRepository;
	}

	private BookingRepository $bookingRepository;
	public function getBookingRepository(): BookingRepository
	{
		return $this->bookingRepository;
	}

	private FacilityRepository $facilityRepository;
	public function getFacilityRepository(): FacilityRepository
	{
		return $this->facilityRepository;
	}

	private Announcement_facilitiesRepository $announcement_facilitiesRepository;
	public function getAnnouncement_facilitiesRepository(): Announcement_facilitiesRepository
	{
		return $this->announcement_facilitiesRepository;
	}

	private UserRepository $userRepository;
	public function getUserRepository(): UserRepository
	{
		return $this->userRepository;
	}

	public static function getRm(): self
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->announcementRepository = new AnnouncementRepository();
		$this->bookingRepository = new BookingRepository();
		$this->facilityRepository = new FacilityRepository();
		$this->announcement_facilitiesRepository = new Announcement_facilitiesRepository();
		$this->userRepository = new UserRepository();
	}

	private function __clone()
	{
	}
	private function __wakeup()
	{
	}
}
