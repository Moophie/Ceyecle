<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersFriendship extends Model
{
    use HasFactory;

    public function friendship()
    {
        return $this->hasMany(User::class, 'users_friendships', 'user_id1', 'user_id2');
    }

    // // friendship that this user started
	// protected function friendsOfThisUser()
	// {
	// 	return $this->belongsToMany(User::class, 'users_friendship', 'user_id1', 'user_id2')
	// 	->withPivot('status')
	// 	->wherePivot('status', 'confirmed');
	// }
 
	// // friendship that this user was asked for
	// protected function thisUserFriendOf()
	// {
	// 	return $this->belongsToMany(User::class, 'users_friendship', 'user_id2', 'user_id1')
	// 	->withPivot('status')
	// 	->wherePivot('status', 'confirmed');
	// }
 
	// // accessor allowing you call $user->friends
	// public function getFriendsAttribute()
	// {
	// 	if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();
	// 	return $this->getRelation('friends');
	// }
 
	// protected function loadFriends()
	// {
	// 	if ( ! array_key_exists('friends', $this->relations))
	// 	{
	// 	$friends = $this->mergeFriends();
	// 	$this->setRelation('friends', $friends);
	// }
	// }
 
	// protected function mergeFriends()
	// {
	// 	if($temp = $this->friendsOfThisUser)
	// 	return $temp->merge($this->thisUserFriendOf);
	// 	else
	// 	return $this->thisUserFriendOf;
	// }
}
