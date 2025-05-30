<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function createdBy()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
