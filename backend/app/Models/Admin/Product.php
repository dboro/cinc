<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Account[] $accounts
 *
 * @package App\Models
 */
class Product extends AdminModel
{
    use HasFactory;
	use SoftDeletes;
    use HasRelationships;

    public const ADMINPANEL = 1;

	protected $table = 'products';

	protected $fillable = [
		'name',
		'slug',
		'description'
	];

	public function accounts() : HasMany
	{
		return $this->hasMany(Account::class);
	}


}
