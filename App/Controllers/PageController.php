<?php

namespace App\Controllers;

use App\View;


class PageController
{
	/**
	 * Site Home page
	 */
	public function index(): void
	{

		$view = new View( 'pages\home' );

		$view->render([
			'html_title' => 'Simple Framework Starter'
		]);
	}
}