<?php


namespace App\Http\Dto\Admin\Account;


use Dboro\LaravelStart\Dto\StartDto;

class AddUserAccountDto extends StartDto
{
    protected int $id;
    protected bool $isUser;
    protected string $email;

    public function __construct(int $id, bool $isUser, string $email)
    {
        $this->id = $id;
        $this->isUser = $isUser;
        $this->email = $email;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function isUser() : bool
    {
        return $this->isUser;
    }

    public function getEmail() : string
    {
        return $this->email;
    }
}
