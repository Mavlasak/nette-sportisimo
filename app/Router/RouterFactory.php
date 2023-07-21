<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
        $router->addRoute('produkt', 'Product:index');
        $router->addRoute('kosik/pridat-produkt', 'Cart:addToCart');
        $router->addRoute('kosik', 'Cart:index');
		$router->addRoute('znacka', 'Trademark:index');
        $router->addRoute('znacka/nova/', 'Trademark:new');
        $router->addRoute('znacka/<id>[0-9]', 'Trademark:edit');
        $router->addRoute('znacka/<id>[0-9]/smazat', 'Trademark:delete');
        $router->addRoute('produkt', 'Product:index');
        $router->addRoute('produkt/<id>', 'Product:detail');
		return $router;
	}
}
