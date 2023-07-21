<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Cart\CartService;
use App\Model\Product\ProductService;
use App\Model\Trademark\Form\NewOrderFormControl;
use App\Model\Trademark\Form\NewOrderFormData;
use App\Utils\ExchangeRate;
use Nette;

final class ProductPresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private ProductService $productService,
        private CartService $cartService,
    ) {}

    public function renderIndex(): void
    {
        $cartItemsCount = $this->cartService->getCartItemsCount();
        $cartItemsPriceSum = $this->cartService->getCartItemsPriceSum();

        $this->template->cartItemsPriceSum = $cartItemsPriceSum;
        $this->template->cartItemsCount = $cartItemsCount;
        $this->template->eurczratio = ExchangeRate::getExchangeRate(ExchangeRate::EUR_CURRENCY);
        $this->template->products = $this->productService->findAll();
    }

    public function actionDetail(int $id): void
    {
        $this->template->eurczratio = ExchangeRate::getExchangeRate(ExchangeRate::EUR_CURRENCY);
        $this->template->product = $this->productService->findOneById($id);
    }
}
