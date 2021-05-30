<?php

namespace App;

class View
{
	private const VIEW_PATH = APP_ROOT . 'App' . DS . 'views' . DS;
	private const PARTIALS_PATH = self::VIEW_PATH . '_partials' . DS;

	private string $template_name;

	public static function render404(): void
	{
		http_response_code( 404 );

		$view = new self( '404' );
		$view->render( [ 'html_title' => 'Page not found' ] );
	}

	public static function render500(): void
	{
		http_response_code( 500 );

		$view = new self( '500' );
		$view->render( [ 'html_title' => 'Server error' ] );
	}

	/**
	 * View constructor.
	 * @param string $template Template name defined by it's path starting from the "views" folder (ex: "pages\home")
	 */
	public function __construct( string $template )
	{
		$this->template_name = $template;
	}

	public function render( array $view_data = [] ): void
	{
		extract( $view_data );

		$template_path = str_replace( '\\', DS, $this->template_name );

		require_once self::PARTIALS_PATH . 'header.php';
		require_once self::VIEW_PATH . $template_path . '.php';
		require_once self::PARTIALS_PATH . 'footer.php';
	}
}