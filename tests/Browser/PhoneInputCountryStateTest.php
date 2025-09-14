<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class PhoneInputCountryStateTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputCountryStateResource::class;

    /** @test */
    public function it_can_state_phone_country()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.data.phone')
                ->pause(300)
                ->typeSlowly('@phone-input.data.phone input.fi-input', '5301111111')
                ->pause(300)
                ->assertScript('window.duskCountryValue', 'US')
        );
    }
}

class PhoneInputCountryStateResource extends FilamentPhoneInputUserResource
{
    public static function getPhoneInput(): ?PhoneInput
    {
        return parent::getPhoneInput()->countryStatePath('phone_country')->initialCountry('US');
    }
}
