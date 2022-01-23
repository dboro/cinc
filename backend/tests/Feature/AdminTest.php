<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * @test
     */
    public function login()
    {
        $response = $this->post('login', ['email' => 'ededed', 'password' => 'dededed']);
       // $data = $this->getData($response->content(), 'data');
        //dd($data);
        $response->assertStatus(200);


    }

    public function getData($data, $key = false)
    {
        $content = json_decode($data, true);

        if ($key) {
            return $content[$key];
        }
        else {
            return $content;
        }
    }
}
