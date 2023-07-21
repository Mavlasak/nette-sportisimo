<?php declare(strict_types=1);

namespace App\Model\Cart\Form;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;
use App\Model\Cart\Form\NewOrderFormData;

class NewOrderFormControl extends Control
{
    public array $onSave = [];

    protected function createComponentNewForm(): Form
    {
        $form = new Form;
        $form->addText('name', 'Jméno:')->setRequired('Zadejte jméno');
        $form->addText('surname', 'Příjmení:')->setRequired('Zadejte příjmení');
        $form->addEmail('email', 'Email:')->setRequired('Zadejte email uživatele')->addRule(Form::EMAIL, 'Email není platný.');
        $form->addText('phone', 'Telefon:')->setRequired('Zadejte telefonní číslo');
        $form->addSubmit('send', 'Odeslat');
        $form->onSuccess[] = [$this, 'processForm'];

        return $form;
    }

    public function processForm(Form $form): void
    {
        $this->onSave($form->getValues(NewOrderFormData::class));
    }

    public function render(): void
    {
        $this->template->render(__DIR__ . '/new.latte');
    }
}
