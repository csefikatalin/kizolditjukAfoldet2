<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tevekenyseg;

class Bejegyzes extends Model
{
    use HasFactory;
    public function tevekenyseg()
    {
        return $this->hasOne(Tevekenyseg::class, 'id', 'tevekenysegId');
    }
}
