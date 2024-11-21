<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    // protected $table = 'reservations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = [];
    protected $fillable = [
        'status',
        'location_quantity',
        'event_id',
        'user_id'
    ];

    // protected $hidden = [
    // ];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    // Relación con Evento
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');  // Cambié 'evento_id' por 'event_id'
    }

    // Relación con Usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
