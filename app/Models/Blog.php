<?php
/**
 * Class BlogController
 *
 * @author Rafael
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'status', 'user_id',
    ];

    /**
     * Get the blog record associated with the author(user).
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
