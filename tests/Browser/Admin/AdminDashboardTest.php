<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use Illuminate\Support\Facades\Hash;

class AdminDashboardTest extends DuskTestCase
{ 
    

    /** @test */
    public function admin_can_view_dashboard_and_see_statistics()
    {

        // Buat data dummy dengan ciri khusus
        $dummyAdmin = User::factory()->create([
            'name' => 'DUMMY_ADMIN_FOR_TEST',
            'email' => 'dummy_admin_for_test@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $this->browse(function (Browser $browser) use ($dummyAdmin) {
            $browser->loginAs($dummyAdmin)
                ->visit('/admin/dashboard')
                ->assertSee('Dashboard');
        });

        // Hapus data dummy setelah test
        User::where('email', 'dummy_admin_for_test@example.com')->delete();
    }
}
