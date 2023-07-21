<?php declare(strict_types=1);

namespace App\Model\Product;

use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
    ) {}

    public function findAll(): Selection
    {
        return $this->productRepository->findAll();
    }

    public function findOneById(int $id): ActiveRow
    {
        return $this->productRepository->findOneById($id);
    }
}
