<?php

namespace Ashmawi\LaravelFollow\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{

   // The attributes that are mass assignable.
   protected $fillable = ['user_id', 'following_id', 'followed_at'];
    
   // The attributes that should be mutated to dates.
   protected $dates = ['followed_at'];

   // Indicates if the model should be timestamped.
   public $timestamps = false;


   //  Create a new Eloquent model instance.
   public function __construct(array $attributes = [])
   {
      parent::__construct($attributes);
      $this->table = config('follow.table_name');
   }

   public function followers() {
      return $this->belongsTo(config('follow.user'), 'user_id');
   }

   public function followings()
   {
      return $this->belongsTo(config('follow.user'), 'following_id');
   }

}
