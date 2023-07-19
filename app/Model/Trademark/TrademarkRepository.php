<?php declare(strict_types=1);

namespace App\Model\Trademark;

use Nette\Database\Connection;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class TrademarkRepository {

    private const TABLE_NAME = 'Trademark';
    private object $bookManager;

    public function __construct(
        private Connection $database,
        private Explorer $explorer,
    ) {
        $this->bookManager = $this->explorer->table(self::TABLE_NAME);
    }

    public function save(array $trademark): void
    {
        $this->bookManager->insert($trademark);
    }

    public function exist(string $name): bool
    {
        return $this->bookManager->where(['name' => $name])->count() > 0;
    }

    public function getAllOrderByName(int $limit, int $offset, bool $desc): Selection
    {
        $qb = $this->bookManager->limit($limit, $offset);
        if ($desc) {
            $qb->order('name DESC');
        } else {
            $qb->order('name');
        }

        return $qb;
    }

    public function findOneBy(array $array): ActiveRow
    {
        return $this->bookManager->where($array)->limit(1)->fetch();
    }

    public function delete(int $id): void
    {
        $this->bookManager->where('id', $id)->delete();
    }

    public function getAllCount(): int
    {
        return $this->bookManager->count();
    }

    public function update(int $id, array $data): void
    {
        $this->database->query('UPDATE ' . self::TABLE_NAME . ' SET', $data, 'WHERE id = ?', $id);
    }
}
