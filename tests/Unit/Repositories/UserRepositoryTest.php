<?php

use App\User;
use App\Repositories\Eloquent\UserRepository;

class UserRepositoryTest extends TestCase
{
    protected $user;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function setUp() : void
    {
        $this->user = [
            'name' => 'NGUYEN NGOC THANH',
            'email' => 'thanh.nn1106@gmail.com',
            'referral_code' => 'THANH1',
            'created_at' => '2021-03-04',
            'updated_at' => '2021-03-04'
        ];
        $user = new User();
        $this->userRepository = new UserRepository($user);
    }

    /**
     * testFindUserByReferralCode
     *
     * @return void
     */
    public function testFindUserByReferralCode()
    {
        $user = $this->userRepository->findUserByReferralCode($this->user['referral_code']);
        $this->assertEquals($this->user, $user);
    }

    /**
     * testFindUserByReferralCodeNotFound
     *
     * @return void
     */
    public function testFindUserByReferralCodeNotFound()
    {
        $user = $this->userRepository->findUserByReferralCode('InValidCode');
        $this->assertEquals([], $user);
    }
}
