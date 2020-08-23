<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Employee;
use Illuminate\Support\Facades\Event;


class EmployeeTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_add_employee()
    {
        Event::fake();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post('/employees', [
            'first_name' => 'test',
            'last_name' => 'test'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('employees', [
            'first_name' => 'test'
        ]);
    }

    /** @test */
    public function user_can_edit_employee()
    {
        $user = factory(User::class)->create();
        $employees = Employee::create([
            'first_name' => 'test',
            'last_name' => 'test'
        ]);

        $response = $this->actingAs($user)
            ->post('/employees'."/".$employees->id, [
            'first_name' => 'test1',
            'last_name' => 'test',            
            '_method' => 'PUT'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('employees', [
        'id' => 1,
        'first_name' => 'test1',            
        ]);
    }
}
