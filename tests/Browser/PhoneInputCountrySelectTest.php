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

class PhoneInputCountrySelectTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputCountrySelectResource::class;

    #[Test]
    public function it_should_be_hidden_country_select_input()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.form.phone')
                ->pause(300)
                ->click('@phone-input.form.phone .iti__selected-country')
                ->pause(300)
                ->assertMissing('.iti__search-input')
        );
    }
}

class PhoneInputCountrySelectResource extends FilamentPhoneInputUserResource
{
    public static function getPhoneInput(): ?PhoneInput
    {
        return parent::getPhoneInput()->countrySearch(false);
    }
}
