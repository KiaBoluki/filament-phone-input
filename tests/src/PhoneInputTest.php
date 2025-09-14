<?php

use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
<<<<<<< HEAD
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUser;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUsers\Pages\EditFilamentPhoneInputUser;
use Ysfkaya\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUsers\Pages\ListFilamentPhoneInputUsers;
use Ysfkaya\FilamentPhoneInput\Tests\TestCase;
=======
use KiaBoluki\FilamentPhoneInput\Forms\PhoneInput;
use KiaBoluki\FilamentPhoneInput\PhoneInputNumberType;
use KiaBoluki\FilamentPhoneInput\Tables\PhoneColumn;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUser;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource\Pages\EditUser;
use KiaBoluki\FilamentPhoneInput\Tests\Fixtures\FilamentPhoneInputUserResource\Pages\ListUsers;
use KiaBoluki\FilamentPhoneInput\Tests\TestCase;
>>>>>>> 3.x

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

uses(TestCase::class);

it('hydrate the phone number given specific number and country', function () {
    FilamentPhoneInputUser::create([
        'name' => 'test',
        'email' => fake()->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'phone' => '(555) 123-4567',
        'phone_country' => 'US',
    ]);

    FilamentPhoneInputUserResource::phoneInput(fn (PhoneInput $input) => $input->countryStatePath('phone_country'));

    livewire(EditFilamentPhoneInputUser::class, ['record' => 1])
        ->assertSuccessful()
        ->assertSet('data.phone', '+15551234567');
});

it('hydrate the phone number given specific number and default country', function () {
    FilamentPhoneInputUser::create([
        'name' => 'test',
        'email' => fake()->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'phone' => '212-975-4846',
    ]);

    FilamentPhoneInputUserResource::phoneInput(fn (PhoneInput $input) => $input->defaultCountry('US'));

    livewire(EditFilamentPhoneInputUser::class, ['record' => 1])
        ->assertSuccessful()
        ->assertSet('data.phone', '+12129754846');
});

it('should be fill the phone input', function ($type) {
    phoneTest(
        fn (PhoneInput $p) => $p->inputNumberFormat(PhoneInputNumberType::from($type))
    )->fillForm([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => 'password',
                'phone' => '+905301111111',
            ])->call('create')->assertHasNoErrors();

    assertDatabaseHas(FilamentPhoneInputUser::class, [
        'phone' => match ($type) {
            PhoneInputNumberType::E164->value => '+905301111111',
            PhoneInputNumberType::INTERNATIONAL->value => '+90 530 111 11 11',
            PhoneInputNumberType::NATIONAL->value => '0530 111 11 11',
            PhoneInputNumberType::RFC3966->value => 'tel:+90-530-111-11-11',
        },
    ]);
})->with([
            PhoneInputNumberType::E164->value,
            PhoneInputNumberType::INTERNATIONAL->value,
            PhoneInputNumberType::NATIONAL->value,
            PhoneInputNumberType::RFC3966->value,
        ]);

it('validate for', function (string $country, string $phone, bool $pass, $type = null, $lenient = false) {
    $test = phoneTest(
        fn (PhoneInput $p) => $p->validateFor($country, $type, $lenient)
    )->fillForm([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => 'password',
                'phone' => $phone,
            ])->call('create');

    if ($pass) {
        $test->assertHasNoFormErrors();
    } else {
        $test->assertHasFormErrors(['phone']);
    }
})->with([
            ['INTERNATIONAL', '+905301111111', true],
            ['TR', '+18143511527', false],
            ['TR', '5301111111', true, null, true],
            ['TR', '+902125111111', true, PhoneNumberType::FIXED_LINE],
        ]);

it('can saves the country code to the database', function () {
    phoneTest(
        fn (PhoneInput $p) => $p->countryStatePath('phone_country')
    )->fillForm([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => 'password',
                'phone' => '+905301111111',
                'phone_country' => 'TR',
            ])->call('create')->assertHasNoErrors();

    assertDatabaseHas(FilamentPhoneInputUser::class, [
        'phone' => '0530 111 11 11',
        'phone_country' => 'TR',
    ]);
});

test('the enum returns the libphonenumber format', function () {
    expect(PhoneInputNumberType::E164->toLibPhoneNumberFormat())->toBe(PhoneNumberFormat::E164);
    expect(PhoneInputNumberType::INTERNATIONAL->toLibPhoneNumberFormat())->toBe(PhoneNumberFormat::INTERNATIONAL);
    expect(PhoneInputNumberType::NATIONAL->toLibPhoneNumberFormat())->toBe(PhoneNumberFormat::NATIONAL);
    expect(PhoneInputNumberType::RFC3966->toLibPhoneNumberFormat())->toBe(PhoneNumberFormat::RFC3966);
});

test('table column formats the phone number', function ($type) {
    FilamentPhoneInputUser::create([
        'name' => 'test',
        'email' => fake()->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'phone' => '+905301111111',
    ]);

    FilamentPhoneInputUserResource::phoneTableColumn(fn (PhoneColumn $column) => $column->displayFormat(PhoneInputNumberType::from($type)));

    livewire(ListFilamentPhoneInputUsers::class)
        ->assertSuccessful()
        ->assertSeeHtml(
            match ($type) {
                PhoneInputNumberType::E164->value => '+905301111111',
                PhoneInputNumberType::INTERNATIONAL->value => '+90 530 111 11 11',
                PhoneInputNumberType::NATIONAL->value => '0530 111 11 11',
                PhoneInputNumberType::RFC3966->value => 'tel:+90-530-111-11-11',
            }
        );
})->with([
            [PhoneInputNumberType::E164->value],
            [PhoneInputNumberType::INTERNATIONAL->value],
            [PhoneInputNumberType::NATIONAL->value],
            [PhoneInputNumberType::RFC3966->value],
        ]);

test('table column formats with country code', function ($type) {
    FilamentPhoneInputUser::create([
        'name' => 'test',
        'email' => fake()->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'phone' => '0530 111 11 11',
        'phone_country' => 'TR',
    ]);

    FilamentPhoneInputUserResource::phoneTableColumn(fn (PhoneColumn $column) => $column->countryColumn('phone_country')->displayFormat(PhoneInputNumberType::from($type)));

    livewire(ListFilamentPhoneInputUsers::class)
        ->assertSuccessful()
        ->assertSeeHtml(
            match ($type) {
                PhoneInputNumberType::E164->value => '+905301111111',
                PhoneInputNumberType::INTERNATIONAL->value => '+90 530 111 11 11',
                PhoneInputNumberType::NATIONAL->value => '0530 111 11 11',
                PhoneInputNumberType::RFC3966->value => 'tel:+90-530-111-11-11',
            }
        );
})->with([
            [PhoneInputNumberType::E164->value],
            [PhoneInputNumberType::INTERNATIONAL->value],
            [PhoneInputNumberType::NATIONAL->value],
            [PhoneInputNumberType::RFC3966->value],
        ]);

it('does not use debugging functions', function () {
    expect(['dd', 'dump', 'var_dump', 'print_r', 'ray'])->not->toBeUsed();
});
