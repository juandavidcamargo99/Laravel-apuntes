<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserModuleTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_it_loads_the_page()
    {
        $response = $this->withoutExceptionHandling();
        $response = $this->get('/usuario');
        $response->assertStatus(200)
        ->assertSee('Usuarios');
    }
      /**
     * A basic feature test example.
     *
     * @return void
     */
    function it_show_the_user_list()
    {
        $response = $this->withoutExceptionHandling();
        $response = $this->get('/usuario');
        $response->assertStatus(200)
        ->assertSee('Juan');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function test_it_loads_detail_users()
    {
        $response = $this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'professionid' => '1',
            'name' => 'Juan David'
        ]);
        $response = $this->get('/usuario/'.$user->userid);
        $response->assertStatus(200);
        
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    function founderror404ifnotfound()
    {
        $response = $this->get('/usuario/9999');
        $response->assertStatus(404);
        $response->assertSee("Pagina no encontrada");
    }
        /** 
     * A basic feature test example.
     *
     * @return void
     */
    function test_it_load_users_create_page()
    {
        $response = $this->get('/usuario/nuevo');
        $response->assertStatus(200);
        $response->assertSee("Crear Usuario");
    }
        /** 
     * A basic feature test example.
     *
     * @return void
     */
    function test_it_creates_a_new_user()
    {
        $this->withoutMiddleware();
        $response = $this->withoutExceptionHandling();
        DB::table('users')->truncate();

        $response = $this->post('/usuario/crear', [
            'professionid' => '1',
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('laravel')
        ])->assertRedirect(route('usuarios'));

        $response = $this->assertCredentials([
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => 'laravel'
        ]);
    }
    /**
     * a basic test
    * @return void
    */
    function test_name_filed_is_required()
    {
    $this->withoutMiddleware();
    DB::table('users')->truncate();
    $response = $this->from(route('usuarios.nuevo'))
    ->post('/usuario/crear', [
        'professionid' => '1',
        'name' => '',
        'email' => 'juan@gmail.com',
        'password' => bcrypt('laravel')
    ])->assertRedirect(route('usuarios.nuevo'))
    ->assertSessionHasErrors(['name']);
    $response = $this->assertDatabaseMissing('users', [
        'email' => 'juan@gmail.com'
    ]);
    }

    /**
     * A basic test for load edit user page.
     *
     * @return void
     */
    function test_it_loads_the_edit_user_page()
    {
        $response = $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $response = $this->get("usuario/{$user->userid}/editar");
        $response->assertStatus(200)
        ->assertViewIs('users.usersedit')
        ->assertSee('Editar usuario')
        ->assertViewHas('user', $user);
    }

    /**
     * A basic test to update users.
     *
     * @return void
     */
    function test_it_updates_users()
    {
        $message="no sirvió prueba incompleta";
        $this->markTestIncomplete($message);
        $this->withoutMiddleware();
        $user = factory(User::class)->create();
        $id = $user["userid"];
        $response = $this->call('put',"/usuario/{$id}",[
            'professionid' => '1',
            'name' => 'Juan David',
            'email' => 'juan@gmail.com',
            'password' => 'laravel'])
            ->assertRedirect('/usuario/'.$id);
        
        $response = $this->assertCredentials([
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => 'laravel'
        ]);
    }
    function test_name_is_required_on_update_form()
    {
        $this->withoutMiddleware();
        DB::table('users')->truncate();
        $user = factory(User::class)->create();
        $response = $this->from("usuario/{$user->userid}/editar")->put("usuario/{$user->userid}",[
        'professionid' => '1',
        'name' => 'Juan David',
        'email' => 'juan@gmail.com',
        'password' => 'laravel'])
        ->assertRedirect("usuario/{$user->userid}/editar")
        ->assertSessionHasErrors(['name'=>'el campo nombre es obligatorio']);


        $response = $this->assertDatabaseMissing('users', ['email'=>'juan@gmail.com']);
    }
    function test_it_deletes_a_user()
    {
        $this->withoutMiddleware();
        $response = $this->withoutExceptionHandling();
        DB::table('users')->truncate();
        $user = factory(User::class)->create([
            'email' => 'juan@gmail.com'
        ]);
        $this->delete("usuario/{$user->userid}")
            ->assertRedirect('usuario');
        $this->assertDatabaseMissing('users', [
            'userid' => $user->userid
        ]);

    }
    
}
