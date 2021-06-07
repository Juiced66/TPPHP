<?php

namespace App;

use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

use App\Controllers\PageController;
use App\Controllers\AnnouncementsC;
use App\Controllers\BookingsController;

class App
{
	/**
	 * @var App|null Singleton instance of the application
	 */
	private static ?self $instance = null;

	/**
	 * @var Router Router instance used in the application
	 */
	private Router $router;

	/**
	 * Gets the singleton instance of the application
	 *
	 * @return App Singleton instance
	 */
	public static function getApp(): self
	{
		if( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Starts the application
	 */
	public function start(): void
	{
		session_start();

		$this->initRouter();
	}

	/**
	 * Router initialization
	 */
	private function initRouter(): void
	{
		$this->router = Router::create();
		$this->registerRoutes();

		try {
			$this->router->dispatch();
		}
		catch( RouteNotFoundException $e_404 ) {
			View::render404();
		}
		catch( InvalidCallableException $e_invalid ) {
			var_dump($e_invalid);
			View::render500();
		}
	}

	/**
	 * Registers the routes to the router
	 */
	private function registerRoutes(): void
	{
		// Patterns for routes arguments
		$this->router->pattern('id', '\d+');

		// Routes
		$this->router->get('/', [PageController::class, 'index']);

		$this->router->get('/login', [PageController::class, 'login']);
		$this->router->post('/login', [PageController::class, 'processLogin']);
		$this->router->get('/deconnexion', [PageController::class, 'logout']);

		$this->router->get('/inscription', [PageController::class, 'subscribe']);
		$this->router->post('/inscription', [PageController::class, 'processSubscribe']);

		$this->router->get('/announcements', [AnnouncementsC::class, 'announcements']);
		$this->router->get('/my-announcements', [AnnouncementsC::class, 'myAnnouncements']);
		$this->router->get('/detail/{id}', [AnnouncementsC::class, 'announcebyid']);
		$this->router->post('/detail/{id}', [AnnouncementsC::class, 'rent']);
		$this->router->get('/create-announcement', [AnnouncementsC::class, 'announcementCreator']);
		$this->router->post('/create-announcement', [AnnouncementsC::class, 'createAnnouncement']);
		
		$this->router->get('/bookings', [BookingsController::class, 'renterBookings']);
		$this->router->get('/announcer-bookings', [BookingsController::class, 'announcerBookings']);
		

	}

	// Singleton pattern locks
	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
}