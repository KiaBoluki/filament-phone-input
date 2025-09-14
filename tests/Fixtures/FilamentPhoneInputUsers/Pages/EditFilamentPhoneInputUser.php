<?php

<<<<<<< HEAD:tests/Fixtures/FilamentPhoneInputUsers/Pages/EditFilamentPhoneInputUser.php
namespace Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUsers\Pages;
=======
namespace KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource\Pages;
>>>>>>> 3.x:tests/Fixtures/FilamentPhoneInputUserResource/Pages/EditUser.php

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class EditFilamentPhoneInputUser extends EditRecord
{
    public static string $resource = FilamentPhoneInputUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
