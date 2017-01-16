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
         return User::with('bankAccount', 'userLevel')->find(1);
      }

      public function isSuperAdmin($upline_user)
      {
         $super_admin = $this->getSuperAdmin();

         if(isset($upline_user->id)){

            if($super_admin->id == $upline_user->id || $upline_user->status != "verified"){

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
            $upline = User::with('bankAccount', 'userLevel')->find($upline_id->user_id);

          if(isset($upline->id)){

            if($step > 1 && $step == 2){
                  $sec_upl_id = UserDownline::where('downline_user_id', $upline->id)
                                             ->where('stage', $stage)
                                             ->first();

               $upline = User::with('bankAccount', 'userLevel')->find($sec_upl_id->user_id);
            }

            if($step > 1 && $step == 3){
                  $third_upl_id = UserDownline::where('downline_user_id', $sec_upl_id->id)
                                          ->where('stage', $stage)
                                          ->first();

               $upline = User::with('bankAccount', 'userLevel')->find($third_upl_id->user_id);
            }
          }

          if(isset($upline->id))
            return $this->isSuperAdmin($upline);

         return $this->getSuperAdmin();
      }

      public function amountToPay($user_level)
      {
         switch ($user_level) {
            case '1':
               return env('LEVEL_ONE');
               break;
            case '2':
               return env('LEVEL_TWO');
               break;
            case '3':
               return env('LEVEL_THREE');
               break;

            default:
               return "Error";
               break;
         }
      }

}