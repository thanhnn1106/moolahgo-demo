<?php

namespace App;

/**
 * Class User
 * @package App
 */
class User
{
    /**
     * @param $referralCode
     *
     * @return array|[]
     */
    public static function getUserByReferralCode($referralCode)
    {
        if ($referralCode === 'THANH1') {
            return [
                'name' => 'NGUYEN NGOC THANH',
                'email' => 'thanh.nn1106@gmail.com',
                'referral_code' => 'THANH1',
                'created_at' => '2021-03-04',
                'updated_at' => '2021-03-04'
            ];
        }

        return [];
    }
}
