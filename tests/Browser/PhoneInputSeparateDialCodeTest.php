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

class PhoneInputSeparateDialCodeTest extends BrowserTestCase
{
    protected ?string $resource = PhoneInputSeparateDialCode::class;

    #[Test]
    public function it_should_be_separate_dial_code()
    {
        $this->phoneTest(
            fn (Browser $browser) => $browser
                ->waitFor('@phone-input.form.phone')
                ->pause(300)
                ->assertSeeIn('@phone-input.form.phone .iti__selected-dial-code', '+90')
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
