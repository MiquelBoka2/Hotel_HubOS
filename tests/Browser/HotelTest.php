<?php

namespace Tests\Browser;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HotelTest extends DuskTestCase
{

    public function testFillCreateHotel()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs("admin@mail.com")

                ->visit('/admin/hotels/create')
                ->assertSee('Add hotel')

                ->type('name', "HotelTest")
                ->type('street', "adressTest")
                ->type('postal_code', "pcTest")
                ->type('city', "cityTest")
                ->type('country', "countryTest")
                ->type('email', "email@test.com")
                ->type('phone', "12345678")
                ->press(trans('web.submit'))
                ->assertSee(trans('web.created_ok'));

        });
    }

    public function testFillEditHotel() {
        $hotel = Hotel::where('name','HotelTest')->first();

        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->loginAs("admin@mail.com")
                ->visit('/admin/hotels')
                ->assertPresent('#edit'.$hotel->id)

                ->click('#edit'.$hotel->id)
                ->assertSee(trans('web.edit', array('attribute' => strtolower(trans_choice('web.hotel', 1)))))
                ->assertValue('#name','HotelTest')

                ->type('name',"HotelTestEdited")

                ->press(trans('web.submit'))
                ->assertSee(trans('web.updated_ok'));

        });
    }
    public function testFillDeleteHotel() {

        $hotel = Hotel::where('name','HotelTestEdited')->first();

        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->loginAs("admin@mail.com")
                ->visit('/admin/hotels')
                ->assertPresent('#delete'.$hotel->id)

                ->click('#delete'.$hotel->id)
                ->waitFor('.modal.show')
                ->click('#modal_delete_btn')
                ->assertSee(trans('web.deleted_ok'));


        });

    }
}
