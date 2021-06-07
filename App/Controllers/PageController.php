<?php

namespace App\Controllers;

use App\View;
use App\Repositories\RepositoryManager;
use Laminas\Diactoros\ServerRequest;


class PageController
{
	/**
	 * Site Home page
	 */
	public function index(): void
	{

		$view = new View('pages\home');

		$view->render([
			'html_title' => 'Accueil'
		]);
	}
    
	public function login(): void
	{

		$view = new View('pages\login');

		$data = [
			'html_title' => 'Connexion'
		];
		// if (isset($_SESSION['LOGIN_ERROR'])) {
		// 	$data['error'] = $_SESSION['LOGIN_ERROR'];
		// 	unset($_SESSION['LOGIN_ERROR']);
		// }

		$view->render($data);
	}
	/**
	 * Login: Traitement POST
	 */
	public function processLogin(ServerRequest $request): void
	{
		$post_data = $request->getParsedBody();

		// TODO_normaly: contrôler la saisie (saisie vide, format d'email, etc.)
		$success = RepositoryManager::getRm()->getUserRepository()->auth($post_data['email'], $post_data['password']);

		if (!$success) {
			header('Location: /login');
			die();
		}

		header('Location: /');
	}

	/**
	 * Deconnection
	 */
	public function logout(): void
	{
		// Demande au navigateur de périmer le cookie de session
		// ini_get() récupère une configuration de php.ini
		if (ini_get('session.use_cookies')) {
			$params = session_get_cookie_params();

			setcookie(
				session_name(),
				'',
				time() - 42000,
				$params['path'],
				$params['domain'],
				$params['secure'],
				$params['httponly']
			);
		}

		// Efface la session sur le serveur
		session_destroy();

		// Demande au navigateur une redirection vers l'accueil
		header('Location: /');
		die();
	}

	public function subscribe(): void
	{

		$view = new View('pages\subscribe');

		$view->render([
			'html_title' => 'S\'inscrire'
		]);
	}

	public function processSubscribe(ServerRequest $request)
	{
		$post_data = $request->getParsedBody();

		// TODO_normaly: contrôler la saisie (saisie vide, format d'email, etc.)
		$success = RepositoryManager::getRm()->getUserRepository()->insc($post_data['username'], $post_data['password'], $post_data['email'], $post_data['role']);

		if (!$success) {
			header('Location: /inscription');
			die();
		}
		$auto_connect = RepositoryManager::getRm()->getUserRepository()->auth($post_data['email'], $post_data['password']);
		header('Location: /');
	}
}
