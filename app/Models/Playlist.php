<?php

namespace App\Models;

use App\Traits\CanFilterByUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int        $user_id
 * @property Collection $songs
 * @property int        $id
 * @property array      $rules
 * @property bool       $is_smart
 * @property string     $name
 * @property user       $user
 *
 * @method static Builder orderBy(string $field, string $order = 'asc')
 */
class Playlist extends Model
{
    use CanFilterByUser;
    use HasFactory;

    protected $hidden = ['user_id', 'created_at', 'updated_at'];
    protected $guarded = ['id'];
    protected $casts = [
        'user_id' => 'int',
        'rules' => 'array',
    ];
    protected $appends = ['is_smart'];

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIsSmartAttribute(): bool
    {
        return (bool) $this->rules;
    }
}
