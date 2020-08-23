<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Company;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_add_company()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/companies', [
            'name' => 'Test company'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('companies', [
            'name' => 'Test company'
        ]);
    }

    /** @test */
    public function user_can_edit_company()
    {
        $user = factory(User::class)->create();
        $companies = Company::create([
            'name' => 'Test company'
        ]);

        $response = $this->actingAs($user)
            ->post('/companies/'.$companies->id, [
            'name' => 'Test company1',
            '_method' => 'PUT'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('companies', [
            'name' => 'Test company1'
        ]);
    }
}
