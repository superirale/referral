<?php
namespace P2P;
use App\User;
use App\UserDownline;

class Assign{

	   private $user;

   	function _construct(/*User $user*/)
   	{
   		// $this->user = $user;
   	}

      public function getSuperAdmin()
      {
         return User::find(1);
      }

      public function isSuperAdmin($upline_user)
      {
         $super_admin = $this->getSuperAdmin();

         if(isset($upline_user->id)){

            if($super_admin->id == $upline_user->id){

               return $super_admin;
            }
            return $upline_user;
         }
         return $super_admin;
      }

      public function getUpline($user_id, $stage = 1, $step = 1)
      {
        $upline_id = UserDownline::where('downline_user_id', $user_id)
                                    ->where('stage', $stage)
                                    ->first();
         if($upline_id)
            $upline = User::find($upline_id->user_id);

          if(isset($upline->id)){
            if($step > 1 && $step == 2){
                  $sec_upl_id = UserDownline::where('downline_user_id', $upline->id)
                                          ->where('stage', 1)
                                          ->first();

               $upline = User::find($sec_upl_id->user_id);
            }

            if($step > 1 && $step == 3){
                  $third_upl_id = UserDownline::where('downline_user_id', $sec_upl_id->id)
                                          ->where('stage', 1)
                                          ->first();

               $upline = User::find($third_upl_id->user_id);
            }
          }

          if(isset($upline->id))
            return $this->isSuperAdmin($upline);
         return $this->getSuperAdmin();
      }

}