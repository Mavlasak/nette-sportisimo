<?php declare(strict_types=1);

namespace App\Model\OrderItem;

use Nette\Database\Connection;
use Nette\Database\Explorer;

final class OrderItemRepository {

    private const TABLE_NAME = 'order_item';

    public function __construct(
        private Connection $database,
        private Explorer $explorer,
    ) {
    }

    public function save(array $orderItem): void
    {
        $this->explorer->table(self::TABLE_NAME)->insert($orderItem);
    }
}
