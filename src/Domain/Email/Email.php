<?php

namespace Alura\Calisthenics\Domain\Email;

class Email
{
    private string $email;

    public function __construct($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            throw new \InvalidArgumentException('Invalid e-mail address');
        }
    $this->email = $email;
    }

 public function __toString(): string
    {
        return $this->email;
    }
}
