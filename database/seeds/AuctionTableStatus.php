<?php

use App\Models\Admin\AuctionStatus;
use Illuminate\Database\Seeder;

class AuctionTableStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuctionStatus::create([
            'name'  => 'Təsdiqlənmiş',
            'color' => '#37bc9b'
        ]);

        AuctionStatus::create([
            'name'  => 'Təsdiqlənməmiş',
            'color' => '#FF0000'
        ]);

        AuctionStatus::create([
            'name'  => 'Rədd edilmiş',
            'color' => '#000000'
        ]);
    }
}
