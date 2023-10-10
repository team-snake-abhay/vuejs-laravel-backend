<?php
    namespace App\Http\Traits;

    use Carbon\Carbon;
    use Illuminate\Support\Str;

    trait UserGenerator
    {
        public function username($id, $prefix)
        {
            $concateID = 1000+$id;
            return $prefix.$concateID;
        }
        public function password()
        {
            $password = Str::random(7);
            return $password;
        }
        public function org($id, $prefix)
        {
            $concateID = 1000+$id;
            return $prefix.$concateID;
        }
    }
