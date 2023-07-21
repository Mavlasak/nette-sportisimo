<?php declare(strict_types=1);

namespace App\Model\Cart\Form;

class NewOrderFormData
{
    public string $name;
    public string $surname;
    public string $email;
    public string $phone;

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
