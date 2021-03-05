<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package App\Repository\Eloquent
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * WagerRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
    }

    /**
     * Select * from users where referral_code = $referralCode
     * User::where('referral_code', '=', $referralCode)->first()
     *
     * @param $referralCode
     *
     * @return User
     */
    public function findUserByReferralCode($referralCode)
    {
        return User::getUserByReferralCode($referralCode);
    }
}
