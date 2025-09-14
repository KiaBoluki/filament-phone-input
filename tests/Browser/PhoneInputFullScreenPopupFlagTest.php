<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class PhoneInputFullScreenPopupFlagTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputFullScreenPopupFlagResource::class;

    /** @test */
    public function it_should_show_fullscreen_popup()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.data.phone')
                ->pause(300)
                ->click('@phone-input.data.phone .iti__selected-country')
                ->pause(300)
                ->assertPresent('.iti--fullscreen-popup')
        );
    }
}

class PhoneInputFullScreenPopupFlagResource extends FilamentPhoneInputUserResource
{
    public static function getPhoneInput(): ?PhoneInput
    {
        return parent::getPhoneInput()->useFullscreenPopup();
    }
}
