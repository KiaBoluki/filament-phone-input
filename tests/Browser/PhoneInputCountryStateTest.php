<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
<<<<<<< HEAD
use PHPUnit\Framework\Attributes\Test;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Tests\BrowserTestCase;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;
=======
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;
>>>>>>> 3.x

class PhoneInputCountryStateTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputCountryStateResource::class;

    #[Test]
    public function it_can_state_phone_country()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.form.phone')
                ->pause(300)
                ->typeSlowly('@phone-input.form.phone input.fi-input', '5301111111')
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
