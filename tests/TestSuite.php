<?php

namespace Ysfkaya\FilamentPhoneInput\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Livewire\LivewireServiceProvider;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;
use Ysfkaya\FilamentPhoneInput\FilamentPhoneInputServiceProvider;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputPanelProvider;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUser;

trait TestSuite
{
    protected function getPackageProviders($app)
    {
        $filamentProviders = [
            ActionsServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            LivewireServiceProvider::class,
            NotificationsServiceProvider::class,
            SchemasServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
        ];

        sort($filamentProviders);

        return [
            ...$filamentProviders,
            FilamentPhoneInputServiceProvider::class,
            FilamentPhoneInputPanelProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        // Test migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('auth.providers.users.model', FilamentPhoneInputUser::class);

        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('app.env', 'testing');
        $app['config']->set('app.key', 'base64:fs7e0Hwi58EfBeSzcP7OuM1gJkUOOMTXdK+5e51umeA=');
    }
}
