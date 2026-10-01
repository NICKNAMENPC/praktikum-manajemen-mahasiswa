<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_mahasiswa_index(): void
    {
        $response = $this->get('/mahasiswa');
        $response->assertRedirect('/login');
    }

    public function test_user_can_view_mahasiswa_index(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/mahasiswa');
        $response->assertStatus(200);
    }

    public function test_user_cannot_access_mahasiswa_create_page(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/mahasiswa/create');
        $response->assertStatus(403);
    }

    public function test_user_cannot_store_mahasiswa(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->post('/mahasiswa', [
            'nim' => '999999',
            'nama' => 'Test Student',
            'program_studi' => 'Teknik Informatika',
            'email' => 'teststudent@example.com',
            'angkatan' => 2024,
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_access_mahasiswa_create_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/mahasiswa/create');
        $response->assertStatus(200);
    }

    public function test_admin_can_store_mahasiswa(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/mahasiswa', [
            'nim' => '220101999',
            'nama' => 'Mahasiswa Baru Admin',
            'program_studi' => 'Teknik Informatika',
            'email' => 'adminmhs@example.com',
            'angkatan' => 2024,
        ]);

        $response->assertRedirect('/mahasiswa');
        $this->assertDatabaseHas('mahasiswas', [
            'nim' => '220101999',
            'email' => 'adminmhs@example.com',
        ]);
    }

    public function test_user_cannot_delete_mahasiswa(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $mahasiswa = Mahasiswa::create([
            'nim' => '220101888',
            'nama' => 'Dummy Student',
            'program_studi' => 'Sistem Informasi',
            'email' => 'dummy@example.com',
            'angkatan' => 2023,
        ]);

        $response = $this->actingAs($user)->delete("/mahasiswa/{$mahasiswa->id}");
        $response->assertStatus(403);
    }

    public function test_admin_can_delete_mahasiswa(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $mahasiswa = Mahasiswa::create([
            'nim' => '220101777',
            'nama' => 'Dummy Student 2',
            'program_studi' => 'Sistem Informasi',
            'email' => 'dummy2@example.com',
            'angkatan' => 2023,
        ]);

        $response = $this->actingAs($admin)->delete("/mahasiswa/{$mahasiswa->id}");
        $response->assertRedirect('/mahasiswa');
        $this->assertDatabaseMissing('mahasiswas', [
            'id' => $mahasiswa->id,
        ]);
    }
}
