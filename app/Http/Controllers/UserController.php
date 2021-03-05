<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use Validator;

/**
 * Class UserController
 * @package Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function process(Request $request)
    {
        $params = $request->json()->all();
        $validator = Validator::make($params, $this->getRules());
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
        $userInfo = $this->userRepository->findUserByReferralCode($params['referral_code']);
        if (empty($userInfo)) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return response()->json($userInfo, 200);
    }

    /**
     * @return array
     */
    private function getRules()
    {
        return [
            'referral_code' => 'required|alpha_num|size:6|uppercase'
        ];
    }
}
