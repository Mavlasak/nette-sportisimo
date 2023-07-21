<?php declare(strict_types=1);

namespace App\Model\Order;

use Nette\Database\Connection;
use Nette\Database\Explorer;

final class OrderRepository {

    private const TABLE_NAME = 'orders';

    public function __construct(
        private Connection $database,
        private Explorer $explorer,
    ) {
    }

    public function save(array $data): int
    {
        return $this->explorer->table(self::TABLE_NAME)->insert($data)->id;
    }
}
