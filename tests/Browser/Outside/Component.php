<?php

namespace KiaBoluki\FilamentPhoneInput\Tests\Browser\Outside;

use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\View;
use Livewire\Component as Livewire;
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;

class Component extends Livewire implements HasSchemas
{
    use InteractsWithSchemas;

    public $data;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            PhoneInput::make('phone'),
        ])->statePath('data');
    }

    public function render()
    {
        return View::file(__DIR__.'/view.blade.php');
    }
}
