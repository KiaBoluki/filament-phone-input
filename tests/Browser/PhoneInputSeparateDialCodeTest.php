<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class PhoneInputSeparateDialCodeTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputSeparateDialCode::class;

    /** @test */
    public function it_should_be_separate_dial_code()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.data.phone')
                ->pause(300)
                ->assertSeeIn('@phone-input.data.phone .iti__selected-dial-code', '+90')
        );
    }
}

class PhoneInputSeparateDialCode extends FilamentPhoneInputUserResource
{
    public static function getPhoneInput(): ?PhoneInput
    {
        return parent::getPhoneInput()->initialCountry('TR')->separateDialCode()->nationalMode(false);
    }
}
