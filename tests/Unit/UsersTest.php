<?php

use App\Core\Users\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    public function testListUsers()
    {
    	$response = $this->call('GET','v1/users/list',[])->getContent();
    	$response = json_decode($response);
        
    	$this->assertEquals(0,$response->status);
    }

    public function testCreateUser()
    {
    	$data = [
    		'name' => Str::random(12),
    		'email' => Str::random(12).'@gmail.com',
    		'password' => Str::random(12),
    		'role_id' => rand(1,4)
    	];
    	$response = $this->call('POST','v1/users/create',$data)->getContent();
    	$response = json_decode($response);
        
    	$this->assertEquals(0,$response->status);        
    }

    public function testShowUser()
    {
    	$data = [
    		'user_id' => User::inRandomOrder()->limit(1)->first()->id,
    	];
    	$response = $this->call('POST','v1/users/show',$data)->getContent();
    	$response = json_decode($response);
        
    	$this->assertEquals(0,$response->status);
    }

    public function testUpdateUser()
    {
    	$data = [
    		'user_id' => User::inRandomOrder()->limit(1)->first()->id,
    		'role_id' => rand(1,4),
    		'email' => Str::random(12).'@qq.com',
    		'password' => Str::random(12),
    	];
    	$response = $this->call('POST','v1/users/update',$data)->getContent();
    	$response = json_decode($response);
        
    	$this->assertEquals(0,$response->status);
    }

    public function testDeleteUser()
    {
        $user_ids = array();
        $user_ids = array_merge($user_ids,User::inRandomOrder()->limit(3)->get('id')->toArray());
        
    	$data = [
    		'user_ids' => $user_ids,
    	];
        
    	$response = $this->call('POST','v1/users/delete',$data)->getContent();
    	$response = json_decode($response);
        
    	$this->assertEquals(0,$response->status);
    }

    public function testUserValidationException()
    {
    	$data = [
    		'name' => Str::random(12),
    		'email' => User::inRandomOrder()->limit(1)->first()->email,
    		'password' => Str::random(12),
    		'role_id' => rand(1,4)
    	];
        
    	try{
            $this->call('POST','v1/users/create',$data); 
        }catch(\Exception $ex){
            $content = $ex->getResponse()->getContent();
            $error_code = json_decode($content)->status;
            $this->assertEquals(40002,$error_code);
        }
    }

    public function testNotFoundException()
    {
        try{
            $this->call('GET','v1/users/listddd',[])->getContent();
        }catch(\Exception $ex){
            $content = $ex->getResponse()->getContent();
            $error_code = json_decode($content)->status;
            $this->assertEquals(40401,$error_code);
        }
    }
}
