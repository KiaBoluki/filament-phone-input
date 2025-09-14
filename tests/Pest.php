<?php

use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource\Pages\CreateUser;

use function Pest\Livewire\livewire;

function phoneTest(?callable $cb = null)
{
    FilamentPhoneInputUserResource::phoneInput($cb);

    return livewire(CreateUser::class);
}
