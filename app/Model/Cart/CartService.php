<?php declare(strict_types=1);

namespace App\Model\Cart;

use App\Model\Product\ProductRepository;
use Nette\Http\Session;
use Nette\Database\Table\Selection;

final class CartService
{
    private const SESSION_SECTION_NAME = 'cart';
    private const CART_ITEMS = 'cart_items';

    public function __construct(
        private Session $session,
        private ProductRepository $productRepository,
    ) {}

    public function addProductsToCart(int $productId, int $productPrice): void
    {
        $cartItems = $this->session->getSection(self::SESSION_SECTION_NAME)->get(self::CART_ITEMS);
        if ($cartItems === null || !isset($cartItems['priceSum'])) {
            $cartItems['priceSum'] = $productPrice;
        } else {
            $cartItems['priceSum'] += $productPrice;
        }
        if (!isset($cartItems['products'][$productId])){
            $cartItems['products'][$productId] = [
                'id' => $productId,
                'count' => 1,
            ];
        } else {
            $cartItems['products'][$productId] = [
                'id' => $productId,
                'count' => ++$cartItems['products'][$productId]['count'],
            ];
        }
        $this->session->getSection(self::SESSION_SECTION_NAME)->set(self::CART_ITEMS, $cartItems);
    }

    public function getCartItemsCount(): int
    {
        $cartItems = $this->session->getSection(self::SESSION_SECTION_NAME)->get(self::CART_ITEMS);
        if ($cartItems === null || !isset($cartItems['products'])) {
            return 0;
        }

        return count($cartItems['products']);
    }

    public function getCartItemsPriceSum(): int
    {
        $cartItems = $this->session->getSection(self::SESSION_SECTION_NAME)->get(self::CART_ITEMS);
        if ($cartItems === null || !isset($cartItems['priceSum'])) {
            return 0;
        }
        return $cartItems['priceSum'];
    }

    public function getCartItems(): array
    {
        return $this->session->getSection(self::SESSION_SECTION_NAME)->get(self::CART_ITEMS);
    }

    public function getAllItems(): Selection
    {
        $cartItems = $this->session->getSection(self::SESSION_SECTION_NAME)->get(self::CART_ITEMS);

        return $this->productRepository->findAllByIds(array_keys($cartItems['products']));
    }
}
