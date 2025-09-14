<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class PhoneInputHidesFlagsTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputHidesFlagResource::class;

    /** @test */
    public function it_should_not_show_flags()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.data.phone')
                ->pause(500)
                ->assertPresent('.iti__flag.iti__globe')
        );
    }
}

class PhoneInputHidesFlagResource extends FilamentPhoneInputUserResource
{
    public static function getPhoneInput(): ?PhoneInput
    {
        return parent::getPhoneInput()->showFlags(false);
    }
}
