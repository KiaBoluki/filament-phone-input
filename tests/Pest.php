<?php

<<<<<<< HEAD
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUsers\Pages\CreateFilamentPhoneInputUser;
=======
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource\Pages\CreateUser;
>>>>>>> 3.x

use function Pest\Livewire\livewire;

function phoneTest(?callable $cb = null)
{
    FilamentPhoneInputUserResource::phoneInput($cb);

    return livewire(CreateFilamentPhoneInputUser::class);
}
