<?php

namespace App\Services;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\SocialAccount;
use App\User;

class SocialFacebookAccountService
{
   public function createOrGetUser(ProviderUser $providerUser)
   {
      // Get the Social Account if it's already in the system
      $account = SocialAccount::whereProvider('facebook')
               ->whereProviderUserId($providerUser->getId())
               ->first();

      // If we found a Social Account
      if(!empty($account)){
         // just return the user of the account
        return $account->user;
      // Else
         // create a Social Account
      }else{
         $account = SocialAccount::create([
            'provider_user_id' => $providerUser->getId(),
            'provider' => 'facebook',
            'image' => $providerUser->getAvatar()
         ]);

         //Finding an user using email.
         $user = User::where('email', $providerUser->getEmail())->first();

         if(empty($user)){
            // create a new user and make the user’s email verfified.
            $user = User::create([
               'name' => $providerUser->getName(),
               'email' => $providerUser->getEmail(),
               'email_verified_at' => now(),
               'avatar' => $providerUser->getAvatar()
            ]);
         }

         //updating id of social user account
         $account->user()->associate($user);
         $account->save();

         return $user;
      }    
   }
}