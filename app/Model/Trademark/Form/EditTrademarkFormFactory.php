<?php declare(strict_types=1);

namespace App\Model\Trademark\Form;

use Nette\Database\Table\ActiveRow;

interface EditTrademarkFormFactory
{
    function create(ActiveRow $trademark): EditTrademarkFormControl;
}
