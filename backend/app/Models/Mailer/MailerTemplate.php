<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Mailer;

use App\Models\Admin\Account;
use App\Models\AppModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MailerTemplate
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $to
 * @property bool $is_to
 * @property string $subject
 * @property string $body
 * @property int $account_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Account $account
 *
 * @package App\Models
 */
class MailerTemplate extends AppModel
{
	use SoftDeletes, HasFactory;

	protected $table = 'mailer_templates';

	protected $casts = [
		'is_to' => 'bool',
		'account_id' => 'int',
        'to' => 'json'
	];

	protected $fillable = [
		'name',
		'description',
		'to',
		'is_to',
		'subject',
		'body',
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}
}
