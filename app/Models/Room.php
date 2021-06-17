<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one', 'id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two', 'id');
    }

    public function users()
    {
        return User::where('id', $this->user_one)
            ->orWhere('id', $this->user_two)
            ->get();
    }

    public function hasUser($id)
    {
        return (($this->user_one == $id) or ($this->user_two == $id));
    }

    public function getRecipient($id)
    {
        return ($this->user_one == $id) ? User::find($this->user_two) : User::find($this->user_one);
    }

    public function getRecipientForAuthId()
    {
        return ($this->user_one == auth()->id()) ? User::find($this->user_two) : User::find($this->user_one);
    }
}
