<?php 

namespace Ashmawi\LaravelFollow\Traits;

use App\Models\User;
use Ashmawi\LaravelFollow\Models\UserFollow;

trait Followable {
   
   public function follow(User $user) {
      if(!$this->isFollowing($user)) {
         UserFollow::create([
            'user_id' => auth()->id(),
            'following_id' => $user->id
         ]);
      }
  }

  public function unfollow(User $user) {
      UserFollow::where('user_id', auth()->id())->where('following_id', $user->id)->delete();
   }

   public function isFollowing(User $user) {
      return $this->following()->where('users.id', $user->id)->exists();
   }

   public function following() {
      return $this->hasManyThrough(User::class, UserFollow::class, 'user_id', 'id', 'id', 'following_id');
   }

   public function followers() {
      return $this->hasManyThrough(User::class, UserFollow::class, 'following_id', 'id', 'id', 'user_id');
   }

}