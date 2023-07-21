<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Cart\CartService;
use App\Model\Cart\Form\NewOrderFormFactory;
use App\Model\Order\OrderService;
use App\Model\Cart\Form\NewOrderFormData;
use App\Model\Cart\Form\NewOrderFormControl;
use Nette;

final class CartPresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private OrderService $orderService,
        private CartService $cartService,
        private NewOrderFormFactory $newOrderFormFactory,
    ) {}

    public function actionAddToCart(int $productId, int $productPrice): void
    {
        $this->cartService->addProductsToCart($productId, $productPrice);
        $this->redirect('Product:index');
    }

    protected function createComponentNewOrderForm(): NewOrderFormControl
    {
        $control = $this->newOrderFormFactory->create();
        $control->onSave[] = function (NewOrderFormData $data): void
        {
            $this->orderService->createOrder($data);
            $this->flashMessage('Objednávak vytvořena.');
            $this->redirect('index');
        };

        return $control;
    }

    public function actionIndex()
    {
        $items = $this->cartService->getAllItems();
        $this->template->items = $items;
    }
}
