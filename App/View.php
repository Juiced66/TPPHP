<?php

namespace App;

use App\Models\User;

class View
{
	private const VIEW_PATH = APP_ROOT . 'App' . DS . 'views' . DS;
	private const PARTIALS_PATH = self::VIEW_PATH . '_partials' . DS;

	private bool $standalone;
	private string $template_name;

	public static function render403(): void
	{
		http_response_code( 403 );

		$view = new self( '403' );
		$view->render( [ 'html_title' => 'Forbidden' ] );
		die();
	}

	public static function render404(): void
	{
		http_response_code( 404 );

		$view = new self( '404' );
		$view->render( [ 'html_title' => 'Page introuvable' ] );
	}

	public static function render500(): void
	{
		http_response_code( 500 );

		$view = new self( '500' );
		$view->render( [ 'html_title' => 'Une Erreur s\'est produite' ] );
	}

	/**
	 * Outils d'affichage (static, s'utilisent depuis le template comme ceci self::$maPropriété)
	 */
	public static function isAuth(): bool
	{
		return User::isAuth();
	}

	 public static function authUser(): ?User
	{
		return User::fromSession();
	}
	
	public static function isRenter(): bool
    {
        return User::isRenter();
    }
    public static function isAnnouncer(): bool
    {
        return User::isAnnouncer();
    }
	/**
	 * View constructor.
	 * @param string $template Nom du template symbolisé par son chemin à partir du répertoire "views" (ex: "pages\home")
	 */
	public function __construct( string $template, bool $standalone = false )
	{
		$this->standalone = $standalone;
		$this->template_name = $template;
	}

	public function render( array $view_data = [] ): void
	{
		// Extract créé des variables PHP à partir d'un tableau associatif
		// les clés donnent les noms des variables
		extract( $view_data );

		// Reconstitution du chemin fichier en gérant les différence de séparateur de dossier selon l'OS
		$template_path = str_replace( '\\', DS, $this->template_name );

		// Si la page est indépendante (par ex: login), on n'inclut pas header et footer
		if( ! $this->standalone ) {
			require_once self::PARTIALS_PATH . 'header.php';
		}

		require_once self::VIEW_PATH . $template_path . '.php';

		if( ! $this->standalone ) {
			require_once self::PARTIALS_PATH . 'footer.php';
		}
	}
}
