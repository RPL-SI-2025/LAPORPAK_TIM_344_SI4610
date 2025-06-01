<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\DB;

class UserFeedbackTest extends DuskTestCase
{
    protected $testcaseTag;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testcaseTag = 'testcase_' . uniqid();
    }

    protected function tearDown(): void
    {
        DB::table('feedback')->where('testcase_tag', $this->testcaseTag)->delete();
        parent::tearDown();
    }

    /** @test */
    public function user_can_submit_feedback_after_report_completed()
    {
        $this->browse(function (Browser $browser) {
         
            // Ambil email dummy dari file (baris kedua)
            $dummyInfo = file(base_path('tests/dummy_laporan_id.txt'), FILE_IGNORE_NEW_LINES);
            $dummyEmail = $dummyInfo[1];
            $dummyPassword = 'test12345';
            $browser
                ->visit('/login')
                ->type('email', $dummyEmail)
                ->type('password', $dummyPassword)
                ->press('Login')
                ->pause(1000)
                ->visit('/dashboard/user')
                ->assertPathIs('/dashboard/user')
                ->pause(3000)
                ->press('Notifikasi')
                ->pause(3000);

           
        });
    }
}
