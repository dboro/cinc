<?php


namespace App\Http\Dto\Admin\Account;


use Dboro\LaravelStart\Dto\StartDto;

class GetUsersAccountDto extends StartDto
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
