<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Kpost;

class KpostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Posts enviados a Peter

        $kpost = new Kpost;
        $kpost->post_id = 1;
        $kpost->user_id = 2;
        $kpost->sent_by = 1;
        $kpost->sent_at = Carbon::now();
        $kpost->save();

        $kpost = new Kpost;
        $kpost->post_id = 2;
        $kpost->user_id = 2;
        $kpost->sent_by = 1;
        $kpost->sent_at = Carbon::now();
        $kpost->save();

        // Posts enviados a Jorge

        $kpost = new Kpost;
        $kpost->post_id = 9;
        $kpost->user_id = 1;
        $kpost->sent_by = 2;
        $kpost->sent_at = Carbon::now();
        $kpost->save();

        $kpost = new Kpost;
        $kpost->post_id = 10;
        $kpost->user_id = 1;
        $kpost->sent_by = 2;
        $kpost->sent_at = Carbon::now();
        $kpost->save();

        //Posts de usuarios enviados a Jorge
        /* QUITAR ESTO (OJO)
        $kpost = new Kpost;
        $kpost->post_id = 13;
        $kpost->user_id = 1;
        $kpost->sent_by = 2;
        $kpost->sent_at = Carbon::now();
        $kpost->save();

        $kpost = new Kpost;
        $kpost->post_id = 14;
        $kpost->user_id = 1;
        $kpost->sent_by = 2;
        $kpost->sent_at = Carbon::now();
        $kpost->save();

        $kpost = new Kpost;
        $kpost->post_id = 15;
        $kpost->user_id = 1;
        $kpost->sent_by = 2;
        $kpost->sent_at = Carbon::now();
        $kpost->save();

        $kpost = new Kpost;
        $kpost->post_id = 16;
        $kpost->user_id = 1;
        $kpost->sent_by = 2;
        $kpost->sent_at = Carbon::now();
        $kpost->save();
        */
    }
}
