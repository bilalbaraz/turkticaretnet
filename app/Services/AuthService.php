<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $data
     * @return User|null
     */
    public function signUp(array $data): ?User
    {
        $data['password'] = $this->encryptPassword($data['password']);

        return $this->user->create($data);
    }

    public function getUserByEmailAndPassword(array $credentials): ?User
    {
        return $this->user->where($credentials)->first();
    }

    public function encryptPassword(string $password): string
    {
        return Hash::make($password);
    }
}