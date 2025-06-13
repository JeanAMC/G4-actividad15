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
    if ($users instanceof User) {
        $this->guardAgainstTooManyMembers();
        return $this->users()->save($users);
    }

    foreach ($users as $user) {
        $this->guardAgainstTooManyMembers();
        $this->users()->save($user);

    }
}
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers()
    {
        if ($this->users()->count() >= $this->size) {
            throw new Exception('No se pueden agregar más usuarios: el equipo ya está completo.');
        }
    }
}
