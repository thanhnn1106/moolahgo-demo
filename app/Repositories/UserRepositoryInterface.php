<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findUserByReferralCode($referralCode);
}
