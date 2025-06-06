<?php

namespace App\Models;

use App\Enums\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $casts = [
        'type' => Type::class,
    ];

    protected $fillable = [
        'conversation_id',
        'user_id',
        'body',
        'type'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => __('User')
        ]);
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'recipients')
            ->withPivot([
                'read_at',
                'deleted_at'
            ]);
    }


}
