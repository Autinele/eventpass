<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evenement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['titre', 'description', 'date_debut', 'date_fin', 'statut', 'limite_participants', 'participants_count'];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

}
