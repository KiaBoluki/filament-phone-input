<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class PhoneInputNullStatmentTest extends BrowserTestCase
{
    protected ?string $resource = FilamentPhoneInputUserResource::class;

    /** @test */
    public function it_sets_null_value_after_reinit()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->pause(300)
                ->waitFor('@phone-input.data.phone')
                ->type('#data\\.name', 'John Doe')
                ->type('#data\\.password', 'password')
                ->type('#data\\.email', 'john@doe.com')
                ->pause(300)
                ->typeSlowly('@phone-input.data.phone input.fi-input', '5301111111')
                ->pause(300)
                ->click('button[wire\\:click="createAnother"]')
                ->pause(750)
                ->assertValue('@phone-input.data.phone input.fi-input', null)
        );
    }
}
