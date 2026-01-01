<?php

use Devdojo\Auth\Helper;
use Illuminate\Support\Facades\App;
use Livewire\Livewire;

it('loads English translations by default', function () {
    App::setLocale('en');
    
    $translation = trans('auth::auth.login.page_title');
    
    expect($translation)->toBe('Sign in');
});

it('loads Spanish translations when locale is set to es', function () {
    App::setLocale('es');
    
    $translation = trans('auth::auth.login.page_title');
    
    expect($translation)->toBe('Iniciar sesión');
});

it('Helper trans method returns translation when available', function () {
    App::setLocale('en');
    
    $translation = Helper::trans('auth::auth.login.email_address', 'devdojo.auth.language.login.email_address', 'Email Address');
    
    expect($translation)->toBe('Email Address');
});

it('Helper trans method falls back to config when translation does not exist', function () {
    App::setLocale('en');
    
    // Set a custom config value
    config(['devdojo.auth.language.login.custom_field' => 'Custom Value From Config']);
    
    // Request a translation that doesn't exist
    $translation = Helper::trans('auth::auth.login.custom_field', 'devdojo.auth.language.login.custom_field', 'Default Value');
    
    expect($translation)->toBe('Custom Value From Config');
});

it('Helper trans method returns default when neither translation nor config exists', function () {
    App::setLocale('en');
    
    $translation = Helper::trans('auth::auth.login.nonexistent_key', 'devdojo.auth.language.login.nonexistent_key', 'Default Value');
    
    expect($translation)->toBe('Default Value');
});

it('renders login page with English translations', function () {
    App::setLocale('en');
    
    Livewire::test('auth.login')
        ->assertSee('Sign in')
        ->assertSee('Email Address')
        ->assertSee('Password');
});

it('renders login page with Spanish translations', function () {
    App::setLocale('es');
    
    Livewire::test('auth.login')
        ->assertSee('Iniciar sesión')
        ->assertSee('Dirección de correo electrónico')
        ->assertSee('Contraseña');
});

it('renders register page with English translations', function () {
    App::setLocale('en');
    
    Livewire::test('auth.register')
        ->assertSee('Sign up')
        ->assertSee('Email Address');
});

it('renders register page with Spanish translations', function () {
    App::setLocale('es');
    
    Livewire::test('auth.register')
        ->assertSee('Registrarse')
        ->assertSee('Dirección de correo electrónico');
});

it('validates all English translation keys exist', function () {
    App::setLocale('en');
    
    $sections = ['login', 'register', 'verify', 'passwordConfirm', 'passwordResetRequest', 'passwordReset', 'twoFactorChallenge'];
    
    foreach ($sections as $section) {
        $translations = trans("auth::auth.$section");
        expect($translations)->toBeArray();
        expect(count($translations))->toBeGreaterThan(0);
    }
});

it('validates all Spanish translation keys exist', function () {
    App::setLocale('es');
    
    $sections = ['login', 'register', 'verify', 'passwordConfirm', 'passwordResetRequest', 'passwordReset', 'twoFactorChallenge'];
    
    foreach ($sections as $section) {
        $translations = trans("auth::auth.$section");
        expect($translations)->toBeArray();
        expect(count($translations))->toBeGreaterThan(0);
    }
});

it('Spanish translations have the same keys as English', function () {
    $englishTranslations = include __DIR__ . '/../../resources/lang/en/auth.php';
    $spanishTranslations = include __DIR__ . '/../../resources/lang/es/auth.php';
    
    expect(array_keys($englishTranslations))->toBe(array_keys($spanishTranslations));
    
    foreach ($englishTranslations as $section => $englishKeys) {
        expect(array_keys($englishKeys))->toBe(array_keys($spanishTranslations[$section]));
    }
});

it('translates continue_with text correctly in English', function () {
    App::setLocale('en');
    
    $translation = Helper::trans('auth::auth.login.continue_with', 'devdojo.auth.language.login.continue_with', 'Continue with');
    
    expect($translation)->toBe('Continue with');
});

it('translates continue_with text correctly in Spanish', function () {
    App::setLocale('es');
    
    $translation = Helper::trans('auth::auth.login.continue_with', 'devdojo.auth.language.login.continue_with', 'Continue with');
    
    expect($translation)->toBe('Continuar con');
});
