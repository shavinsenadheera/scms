<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderAPITest extends TestCase{

    public function test_can_retrieve_order(){
        $response = $this->get('/api/get-orders/dsadas');
        $response->assertStatus(200);
    }

    public function test_can_retrieve_orders(){
        $response = $this->get('/api/get-all-orders/1sdasd');
        $response->assertStatus(200);
    }

    public function test_can_create_order(){
        $form =   [
            "inputList" => [
                [
                    "delivery_date" => "2022-01-23",
                    "label_type" => "2",
                    "style_no" => "3",
                    "referencedoc" => "",
                    "size_no" => "3",
                    "qty" => "100"
                ],
                [
                    "size_no" => "2",
                    "qty" => "200"
                ],
                [
                    "size_no" => "3",
                    "qty" => "300"
                ]
            ],
            "count" => 3,
            "customerid" => "5"
        ];
        $response = $this->post('/api/make-order', $form);
        $response->assertStatus(204);
    }
}
