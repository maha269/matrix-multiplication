<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\WithoutMiddleware;

class MultiplicationTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testMultiplyFunctionFail()
    {
        $this->post('/api/multiply', [
            'a' => [[1, 2, 3], [1, 2, 3]],
            'b' => [[1, 2], [2, 3]]
        ]);
        $result = json_encode([
            "status" => "fail",
            "data" => null
        ]);
        $this->assertEquals($result, $this->response->getContent());
    }

    public function testMultiplyFunctionSuccessful()
    {
        $this->post('/api/multiply', [
            'a' => [[1, 2, 3], [1, 2, 3]],
            'b' => [[1, 2], [2, 3], [1, 4]]
        ]);
        $result = json_encode([
            "status" => "success",
            "data" => [
                ["H", "T"],
                ["H", "T"]
            ]
        ]);
        $this->assertEquals($result, $this->response->getContent());
    }
}
