<p align="center"><a href="https://devdojo.com" target="_blank"><img src="https://cdn.devdojo.com/images/april2024/dd-auth-logo.png" width="auto" height="64px" alt="Auth Logo"></a></p>
<br>
<p align="center">
<a href="https://github.com/thedevdojo/auth/actions"><img src="https://github.com/thedevdojo/auth/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/devdojo/auth"><img src="https://img.shields.io/packagist/dt/devdojo/auth" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/devdojo/auth"><img src="https://img.shields.io/packagist/v/devdojo/auth" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/devdojo/auth"><img src="https://img.shields.io/packagist/l/devdojo/auth" alt="License"></a>
</p>

## About

Auth is a plug'n play authentication package for any <a href="https://laravel.com" target="_blank">Laravel application</a>. We have closed **issues** for this repo and are recommending that anyone who wants to report an issue or make a suggestion to do so here: [https://devdojo.com/questions](https://devdojo.com/questions). Additionally, we are open to any kind of Pull Request 😉

<a href="https://devdojo.com/auth" target="_blank"><img src="https://cdn.devdojo.com/images/june2024/devdojo-auth-image.png" class="w-full h-full" style="border-radius:10px" /></a>

Be sure to visit the official documentation at <a href="https://devdojo.com/auth/docs" target="_blank">https://devdojo.com/auth/docs</a>

## Installation

You can install this package into any new Laravel application, or any of the available <a href="https://devdojo.com/auth/docs/install" target="_blank">Laravel Starter Kits</a>.

```
composer require devdojo/auth
```

After the package has been installed you'll need to publish the authentication assets, configs, and more:

```
php artisan vendor:publish --tag=auth:assets
php artisan vendor:publish --tag=auth:config
php artisan vendor:publish --tag=auth:ci
php artisan vendor:publish --tag=auth:migrations
```

Optionally, you can also publish the translation files:

```
php artisan vendor:publish --tag=auth:translations
```

Next, run the migrations:

```php
php artisan migrate
```

Finally extend the Devdojo User Model:

```
use Devdojo\Auth\Models\User as AuthUser;

class User extends AuthUser
```

in your `App\Models\User` model. 

Now, you're ready to rock! Auth has just been installed and you'll be able to visit the following authentication routes:

 - Login (project.test/auth/login)
 - Register (project.test/auth/register)
 - Forgot Password (project.test/auth/register)
 - Password Reset (project.test/auth/password/reset)
 - Password Reset Token (project.test/auth/password/ReAlLyLoNgPaSsWoRdReSeTtOkEn)
 - Password Confirmation (project.test/auth/password/confirm)
 - Two-Factor Challenge (project.test/auth/two-factor-challenge)
  
You'll also have access to the Two Factor Setup page

 - Two-Factor Setup (project.test/user/two-factor-authentication)

When you need to logout, you can visit the Logout route

- Logout Route (project.test/auth/logout)

## (Optional) Adding the HasSocialProviders Trait.

You can add all the social auth helpers to your user model by including the following Trait:

```php
<?php

namespace App\Models;

use Devdojo\Auth\Traits\HasSocialProviders; // Import the trait

class User extends Devdojo\Auth\Models\User
{
    use HasSocialProviders; // Use the trait in the User model

    // Existing User model code...
}
```

## Internationalization (i18n)

The DevDojo Auth package now supports multiple languages out of the box. By default, the package includes English and Spanish translations.

### Supported Languages

- English (en) - Default
- Spanish (es)

### Changing the Application Language

To change the language of your authentication pages, simply set the locale in your Laravel application:

```php
// In your AppServiceProvider or middleware
App::setLocale('es'); // For Spanish
```

You can also set the locale based on user preferences or browser settings:

```php
// Example: Set locale from session or user preference
if (session()->has('locale')) {
    App::setLocale(session('locale'));
}
```

### Publishing and Customizing Translations

If you want to customize the translations, you can publish the language files to your application:

```bash
php artisan vendor:publish --tag=auth:translations
```

This will copy the translation files to `lang/vendor/auth/` in your Laravel application, where you can modify them as needed.

### Adding New Languages

To add support for additional languages:

1. Publish the translation files using the command above
2. Copy one of the existing language directories (e.g., `lang/vendor/auth/en/`) 
3. Rename it to your desired locale code (e.g., `lang/vendor/auth/fr/` for French)
4. Translate the content in the `auth.php` file

### Translation Keys

All authentication pages support translation for:
- Login page
- Registration page  
- Email verification page
- Password reset request page
- Password reset page
- Password confirmation page
- Two-factor authentication challenge page

### Backward Compatibility

The package maintains backward compatibility with the config-based language system. If you have customized the language strings in your `config/devdojo/auth/language.php` file, those will continue to work as fallbacks when translations are not found.
```

## License

The DevDojo Auth package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
