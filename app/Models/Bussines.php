<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bussines extends Model
{
    use HasFactory;
    protected $table = "bussines";
    protected $primaryKey ='id';
    protected $fillable = ['id', 'name'];



    public function definition()
    {

    }

    public function user() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function business() {
        return $this->belongsTo(Bussines::class);
    }
}
