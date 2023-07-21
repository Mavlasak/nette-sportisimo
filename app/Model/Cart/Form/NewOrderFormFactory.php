<?php declare(strict_types=1);

namespace App\Model\Cart\Form;

interface NewOrderFormFactory
{
    function create(): NewOrderFormControl;
}
