<?php


namespace App\Http\Dto\Admin\Account;


use App\Models\Admin\Account;
use Dboro\LaravelStart\Dto\StartDto;

class CheckUserAccountDto extends StartDto
{
    protected $model;
    protected $email;

    /**
     * CheckUserAccountDto constructor.
     * @param Account $model
     * @param string $email
     */
    public function __construct(Account $model, string $email)
    {
        $this->model = $model;
        $this->email = $email;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
