<?php

class UserControllerTest extends TestCase
{
    /**
     * testProcess
     * @dataProvider processDataProvider
     *
     * @param $params
     * @param $statusCode
     * @param $expected
     * @return void
     */
    public function testProcess($params, $statusCode, $expected)
    {
        $this->json('POST', 'api/process', $params)
            ->seeStatusCode($statusCode)
            ->seeJsonEquals($expected);
    }

    /**
     * processDataProvider
     *
     * @return array
     */
    public function processDataProvider()
    {
        return [
            [
                'params' => [
                    'referral_code' => 'THANH1'
                ],
                'statusCode' => 200,
                'expected' => [
                    'name' => 'NGUYEN NGOC THANH',
                    'email' => 'thanh.nn1106@gmail.com',
                    'referral_code' => 'THANH1',
                    'created_at' => '2021-03-04',
                    'updated_at' => '2021-03-04',
                ]
            ],
            [
                'params' => [
                    'referral_code' => 'THANH@'
                ],
                'statusCode' => 400,
                'expected' => [
                    "error" => "The referral code may only contain letters and numbers."
                ]
            ],
            [
                'params' => [
                    'referral_code' => 'THANHa'
                ],
                'statusCode' => 400,
                'expected' => [
                    "error" => "The referral code must be in uppercase."
                ]
            ],
            [
                'params' => [
                    'referral_code' => ''
                ],
                'statusCode' => 400,
                'expected' => [
                    "error" => "The referral code field is required."
                ]
            ],
            [
                'params' => [
                    'referral_code' => 'THANH123'
                ],
                'statusCode' => 400,
                'expected' => [
                    "error" => "The referral code must be 6 characters."
                ]
            ],
            [
                'params' => [
                    'referral_code' => 'THANH2'
                ],
                'statusCode' => 404,
                'expected' => [
                    "message" => "No data found"
                ]
            ]
        ];
    }
}
