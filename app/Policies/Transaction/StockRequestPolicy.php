<?php

namespace App\Policies;

use App\Enum\Role;
use App\Models\User;
use App\Models\Transaction\StockRequest;
use Illuminate\Auth\Access\Response;

class StockRequestPolicy
{
    private function canManageRequest(User $user): bool
    {
        return in_array($user->role, [Role::ADMIN, Role::STAFF]);
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StockRequest $stockRequest): bool
    {
        if ($user->role === Role::ADMIN || $user->role === Role::STAFF) {
            return true;
        }

        return $stockRequest->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function approve(User $user, StockRequest $stockRequest): bool
    {
        return $this->canManageRequest($user);
    }

    public function reject(User $user, StockRequest $stockRequest): bool
    {
        return $this->canManageRequest($user);
    }

    public function update(User $user, StockRequest $stockRequest): bool
    {
        if ($user->role === Role::ADMIN || $user->role === Role::STAFF) {
            return true;
        }

        return $stockRequest->user_id === $user->id;
    }

    public function fulfill(User $user, StockRequest $stockRequest): bool
    {
        return $this->canManageRequest($user);
    }

    public function delete(User $user, StockRequest $stockRequest): bool
    {
        if ($user->role === Role::ADMIN || $user->role === Role::STAFF) {
            return true;
        }

        return $stockRequest->user_id === $user->id;
    }

    public function restore(User $user, StockRequest $stockRequest): bool
    {
        return false;
    }

    public function forceDelete(User $user, StockRequest $stockRequest): bool
    {
        return false;
    }
}
