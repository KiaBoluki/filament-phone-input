<?php

<<<<<<< HEAD:tests/Fixtures/FilamentPhoneInputUsers/Pages/ListFilamentPhoneInputUsers.php
namespace Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUsers\Pages;
=======
namespace KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource\Pages;
>>>>>>> 3.x:tests/Fixtures/FilamentPhoneInputUserResource/Pages/ListUsers.php

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;

class ListFilamentPhoneInputUsers extends ListRecords
{
    public static string $resource = FilamentPhoneInputUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
