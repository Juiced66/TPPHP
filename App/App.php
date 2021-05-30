<?php

namespace App;

use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

use App\Controllers\PageController;

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
		$this->router->get( '/', [ PageController::class, 'index' ] );
	}

	// Singleton pattern locks
	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
}