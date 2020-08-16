<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class OrderPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function view($user, Order $order)
    {
        if (Auth::guard('editor')->check()) {
            return $user->id == $order->editor_id||$order->status =='inediting-unpicked';
        }
        else if (Auth::guard('writer')->check()) {
            return $user->id == $order->writer_id||$order->status =='unassigned';
        }
        else return $user->id == $order->user_id;
    }

    /**
     * Determine whether the user can create orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function update($user, Order $order)
    {
        if (Auth::guard('editor')->check()) {
            return $user->id == $order->editor_id;
        }
        else if (Auth::guard('writer')->check()) {
            return $user->id == $order->writer_id;
        }
        else return $user->id == $order->user_id;
    }

    /**
     * Determine whether the user can delete the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function delete(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can restore the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
