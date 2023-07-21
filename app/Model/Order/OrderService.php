<?php declare(strict_types=1);

namespace App\Model\Order;


use App\Model\Cart\CartService;
use App\Model\Cart\Form\NewOrderFormData;
use App\Model\OrderItem\OrderItemRepository;
use App\Model\Product\ProductRepository;
use Nette\Database\Connection;

final class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private CartService $cartService,
        private ProductRepository $productRepository,
        private OrderItemRepository $orderItemRepository,
        private Connection $database,
    ) {}

    public function createOrder(NewOrderFormData $data): void
    {
        $order = $data->toArray();
        $cartItems = $this->cartService->getCartItems();
        $priceSum = 0;
        foreach ($cartItems['products'] as $key => $product) {
            $productPrice = $this->productRepository->getPriceById($product['id']);
            $cartItems['products'][$key]['price'] = $productPrice;
            $priceSum += $productPrice * $product['count'];
        }
        $order['price'] = $priceSum;

        try {
            $this->database->beginTransaction();
            $orderId = $this->orderRepository->save($order);
            foreach ($cartItems['products'] as $product) {
                $data = [
                    'product_id' => $product['id'],
                    'order_id' => $orderId,
                    'price' => $product['price'],
                ];
                $this->orderItemRepository->save($data);
            }
            $this->database->commit();
        } catch (\Exception $e) {
            $this->database->rollBack();
            throw $e;
        }
    }
}
