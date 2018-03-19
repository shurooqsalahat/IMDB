<?php

namespace Tests\Feature;

use App\Actors;
use Tests\TestCase;
use Auth;
use App\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ExampleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_can_visit_login()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }


    public function test_auth_user_can_create_actor()
    {
        $user =new Users(['name'=>'shurooq' ,'email' => 'shurooqsalahat@gmail.com', 'password'=>bcrypt('123456') , 'is_admin'=>'1']);
        $user->save();
        $this->actingAs($user);
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $response= $this->get(route('actors.index'));
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertSeeText('Well done');
    }
    public function test_auth_user_can_update_actor()
    {
        $user =new Users(['name'=>'shurooq' ,'email' => 'shurooqsalahat@gmail.com', 'password'=>bcrypt('123456') , 'is_admin'=>'1']);
        $user->save();
        $this->actingAs($user);
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $this->put(route('actors.update',1), ['name' => 'sds','information' => 'ddssd' ] );
        $response= $this->get(route('actors.index'));
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertSeeText('Actors Successfully Update');
    }
    public function test_auth_user_can_delete_actor()
    {
        $user =new Users(['name'=>'shurooq' ,'email' => 'shurooqsalahat@gmail.com', 'password'=>bcrypt('123456') , 'is_admin'=>'1']);
        $user->save();
        $this->actingAs($user);
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $this->delete(route('actors.destroy',1));
        $response= $this->get(route('actors.index'));
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertSeeText('Actor Successfully Delete');
    }
   public function test_no_Auth_cant_delete_actor()
    {
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $this->delete(route('actors.destroy',1));
        $response= $this->get(route('out'));
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertSeeText('Login');
    }
    public function test_no_Auth_cant_create_actor()
    {
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $response= $this->get(route('out'));
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertSeeText('Login');
    }

    public function test_no_Auth_cant_update_actor()
    {
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $this->put(route('actors.update',1), ['name' => 'sds','information' => 'ddssd' ] );
        $response= $this->get(route('out'));
        $this->assertEquals(200, $response->getStatusCode());
    }
    public function test_not_owner_cant_update_actor()
    {
        $user1 =new Users(['name'=>'shurooq' ,'email' => 'shurooqsalahat@gmail.com', 'password'=>bcrypt('123456') , 'is_admin'=>'1']);
        $user1->save();
        $this->actingAs($user1);
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $user2 =new Users(['name'=>'shurooq' ,'email' => 'shurooqsalahat@gmail.com', 'password'=>bcrypt('123456') , 'is_admin'=>'1']);
        $user2->save();
        $this->actingAs($user2);
        $response= $this->put(route('actors.update',1), ['name' => 'sds','information' => 'ddssd' ] );
        $response->assertStatus(403);

    }

    public function test_not_owner_cant_delete_actor()
    {
        $user1 =new Users(['name'=>'shurooq' ,'email' => 'shurooqsalahat@gmail.com', 'password'=>bcrypt('123456') , 'is_admin'=>'1']);
        $user1->save();
        $this->actingAs($user1);
        $this->post(route('actors.store'), ['name' => 'Laila','information' => 'ddssd']);
        $user2 =new Users(['name'=>'shurooq' ,'email' => 'shurooqsalahat@gmail.com', 'password'=>bcrypt('123456') , 'is_admin'=>'1']);
        $user2->save();
        $this->actingAs($user2);
        $response=  $this->delete(route('actors.destroy',1));
        $response->assertStatus(403);

    }
}
