<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    protected $guarded = [];
    
    public function add($users)
    {

    $additionals = $users instanceof User ? 1 : count($users);
    $this->guardAgainstTooManyMembers($additionals);

        if ($users instanceof User) {
        return $this->users()->save($users);
        }

    $this->users()->saveMany($users);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers($additional)
    {
        if (($this->users()->count() + $additional) > $this->size) {
        throw new Exception();
        }   
    }
}
