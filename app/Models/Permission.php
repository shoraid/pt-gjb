<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property ?string $parent_id
 * @property string $name
 * @property int $display_order
 * @property ?string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Illuminate\Support\Collection $children
 * @property Permission|null $parent
 * @property \Illuminate\Support\Collection $roles
 */
class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'display_order',
        'description',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'parent_id')->withDefault();
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_has_permission');
    }
}
