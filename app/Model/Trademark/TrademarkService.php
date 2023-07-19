<?php declare(strict_types=1);

namespace App\Model\Trademark;

use App\Model\Trademark\Exception\TrademarkAlreadyExistException;
use App\Model\Trademark\Form\EditTrademarkFormData;
use App\Model\Trademark\Form\NewTrademarkFormData;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class TrademarkService
{
    public function __construct(
        private TrademarkRepository $trademarkRepository,
    ) {}

    public function createIfNotExist(NewTrademarkFormData $formData): void
    {
        $trademarkExist = $this->trademarkRepository->exist($formData->getName());
        if ($trademarkExist) {
            throw new TrademarkAlreadyExistException();
        }
        $this->trademarkRepository->save($formData->toArray());
    }

    public function getAllOrderByName(int $limit, int $offset, bool $desc): Selection
    {
        return $this->trademarkRepository->getAllOrderByName($limit, $offset, $desc);
    }

    public function findOneById(int $id): ActiveRow
    {
        return $this->trademarkRepository->findOneBy(['id' => $id]);
    }

    public function updateIfNotExist(EditTrademarkFormData $formData, int $trademarkId): void
    {
        $trademarkExist = $this->trademarkRepository->exist($formData->getName());
        if ($trademarkExist) {
            throw new TrademarkAlreadyExistException();
        }

        $this->trademarkRepository->update($trademarkId, $formData->toArray());
    }

    public function delete(int $id): void
    {
        $this->trademarkRepository->delete($id);
    }

    public function getAllCount(): int
    {
        return $this->trademarkRepository->getAllCount();
    }
}
