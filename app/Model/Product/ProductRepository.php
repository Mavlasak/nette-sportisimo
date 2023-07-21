<?php declare(strict_types=1);

namespace App\Model\Product;

use Nette\Database\Connection;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class ProductRepository
{

    private const TABLE_NAME = 'product';
    private object $bookManager;

    public function __construct(
        //private Connection $database,
        private Explorer $explorer,
    )
    {
    }

    public function findAll(): Selection
    {
        return $this->explorer->table(self::TABLE_NAME);
    }

    public function findAllByIds(array $ids): Selection
    {
        return $this->explorer->table(self::TABLE_NAME)->where('id', $ids);
    }

    public function getPriceById(int $id): float
    {
        return $this->explorer->table(self::TABLE_NAME)->where('id ?', $id)->fetch()->price;
    }

    public function findOneById(int $id): ActiveRow
    {
        return $this->explorer->table(self::TABLE_NAME)->where('id ?', $id)->fetch();
    }
}
