<?php

namespace Tests\Unit;

use App\Category;
use App\Location;
use App\Products;
use App\Users;
use Tests\TestCase;

class MenuTest extends TestCase
{
    public function testGetMenu()
    {
        $randomLocation = Location::where('active', 1)->first();

        if($randomLocation == null){
            $response = $this->get("api/menu");
            $response->assertStatus(200)->assertJson([
                'status' => false
            ]);
        }else {

            $result = [];
            $menu = Category::with(['menuItems' => function($query) use($randomLocation){
                $query->where('location_id', $randomLocation->id);
            }, 'menuItems.option'])
                ->orderBy('category.queue', 'ASC')
                ->get();
            foreach ($menu as $data){
                $menuItem['id'] = $data['id'];
                $menuItem['name'] = $data['name'];
                $menuItem['position'] = $data['queue'];
                $menuItem['categoryImage'] = $data['img'];
                $items = [];
                foreach ($data->menuItems as $dataItem){
                    $item = [];
                    $item['id'] = $dataItem['id'];
                    $item['name'] = $dataItem['name'];
                    $item['position'] = $dataItem['queue'];
                    $item['price'] = $dataItem['price'];
                    $item['category_name'] = $data['name'];
                    $item['quantity'] = 1;
                    $item['description'] = $dataItem['card_text'];
                    $item['img'] = $dataItem['img'];
                    $items[] = $item;
                }
                $menuItem['menuItems'] = $items ;
                $result[] = $menuItem;
            }

            $response = $this->get("api/menu?location={$randomLocation->id}");
            $response->assertStatus(200)->assertJson($result);
        }

    }

    public function testUserNotLoginSepetUpdate()
    {
        $response = $this->postJson('user/sepet', []);

        $response->assertStatus(302);
    }

    public function TestUserLoginSepetUpdate()
    {
        $product = Products::all()->random(1)->first();
        $user = Users::all()->random(1)->with(['address.address'])->first();

        $response = $this->withSession([
            'userId' => $user->id
        ])->postJson('user/sepet', [
            'id' => $product->id,
            'count' => 1
        ]);

        if($user->address->address->id === $product->location_id){
            $response->assertStatus(200)->assertJson([
                'status' => true
            ]);
        }else {
            $response->assertStatus(401);
        }

    }
}
