<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class AccountUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $account_id
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class AccountUser extends AdminModel
{
    use HasFactory, HasRoles;

	protected $table = 'account_user';
    protected $guard_name = 'web';

	protected $casts = [
		'user_id' => 'int',
		'account_id' => 'int',
		'active' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'account_id',
		'active'
	];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
