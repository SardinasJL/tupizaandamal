<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Failure extends Model
{
    use HasFactory;
    protected $table="failures";
    protected $primaryKey="id";
    protected $guarded=["id"];
    public function relStates()
    {
        return $this->belongsTo(State::class, "states_id", "id");
    }
    public function relUsers()
    {
        return $this->belongsTo(User::class, "users_id", "id");
    }

}
