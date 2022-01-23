<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $product_id
 * @property string|null $description
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Product $product
 *
 * @package App\Models
 */
class Account extends Model
{
    use HasFactory;
	use SoftDeletes;
	protected $table = 'accounts';

	protected $casts = [
		'product_id' => 'int',
		'active' => 'bool'
	];

	protected $fillable = [
		'name',
		'slug',
		'product_id',
		'description',
		'active'
	];

	public function product() : BelongsTo
	{
		return $this->belongsTo(Product::class)->withTrashed();;
	}

	public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
