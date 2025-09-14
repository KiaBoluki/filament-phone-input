<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser;

use Laravel\Dusk\Browser;
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\PhoneInputNumberType;
use KiaBoluki\FilamentPhoneInput\Tests\BrowserTestCase;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class PhoneInputDisplayFormatTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputDisplayFormatResource::class;

    /** @test */
    public function it_should_be_display_number_format_as_international()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.data.phone')
                ->click('@phone-input.data.phone input.fi-input')
                ->typeSlowly('@phone-input.data.phone input.fi-input', '5301111111')
                ->pause(300)
                ->assertValue('@phone-input.data.phone input.fi-input', '+90 530 111 11 11')
        );
    }
}

class PhoneInputDisplayFormatResource extends FilamentPhoneInputUserResource
{
    public static function getPhoneInput(): ?PhoneInput
    {
        return parent::getPhoneInput()->initialCountry('TR')->displayNumberFormat(PhoneInputNumberType::INTERNATIONAL)->formatAsYouType(false);
    }
}
