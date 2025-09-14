<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class PhoneInputInitialCountryTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputFlagResource::class;

    /** @test */
    public function it_should_be_render_with_initial_country()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->pause(300)
                ->click('@phone-input.data.phone')
                ->pause(300)
                ->with('@phone-input.data.phone', function (Browser $browser) {
                    $browser->assertAttribute('.iti__selected-country', 'title', 'Turkey: +90');
                })
        );
    }
}

class PhoneInputFlagResource extends FilamentPhoneInputUserResource
{
    public static function getPhoneInput(): ?PhoneInput
    {
        return parent::getPhoneInput()->initialCountry('TR');
    }
}
