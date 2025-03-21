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

/**
     * Encoder l'ID de l'événement pour sécuriser l'URL
     */
    public function encodeId()
    {
        return base64_encode($this->id);
    }

    /**
     * Décoder l'ID de l'événement à partir de l'URL sécurisée
     */
    public static function decodeId($hashedId)
    {
        return base64_decode($hashedId);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants');
    }
}
