<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Admin $admin)
    {
        return in_array($admin->id,[
            1
        ]);
    }
}
