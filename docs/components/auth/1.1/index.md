# Auth

Laravel Auth package with buit-in two-factor (Authy) and social authentication (Socialite).

## Installation

Via Composer

``` bash
$ composer require awema-pl/auth
```

The package will automatically register itself.

You can publish migrations:

```bash
php artisan vendor:publish --provider="AwemaPL\Auth\AuthServiceProvider" --tag="migrations"
```

After migrations have been published you can create required db tables by running:

```bash
php artisan migrate
```

Publish views:

```bash
php artisan vendor:publish --provider="AwemaPL\Auth\AuthServiceProvider" --tag="views"
```

## Configuration

Publish config file:

```bash
php artisan vendor:publish --provider="AwemaPL\Auth\AuthServiceProvider" --tag="config"
```

You can disable additional features by commenting them out:

```php
'enabled' => [
    'social', 
    // 'two_factor',
    // 'email_verification',
],
```

Add new socialite services:

```php
'services' => [
    'github' => [
        'name' => 'GitHub'
    ],
    ...
],
'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    ...
],
```

And configure redirect paths:

```php
'redirects' => [
    'login' => '/twofactor',
    'reset_password' => '/',
    ...
],
```

### Social and two-factor authentication

Several .env variables required if additional modules were enabled in config:

```php
# SOCIALITE GITHUB
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT_URL=http://auth.test/login/github/callback

# TWO FACTOR AUTHY
AUTHY_SECRET=
```

If you enabled social and/or two factor authentication add respective traits to User model class:

```php
use AwemaPL\Auth\Models\Traits\HasSocialAuthentication;
use AwemaPL\Auth\Models\Traits\HasTwoFactorAuthentication;

class User extends Authenticatable
{
    use HasSocialAuthentication, HasTwoFactorAuthentication;
}
```

### Email verification & resetting passwords

To use email verification functionality and to reset passwords, add `SendsEmailVerification` and `SendsPasswordReset` traits:

```php
use AwemaPL\Auth\Models\Traits\SendsPasswordReset;
use AwemaPL\Auth\Models\Traits\SendsEmailVerification;

class User extends Authenticatable
{
    use SendsEmailVerification, SendsPasswordReset;
}
```

## Usage

Add to routes/web.php:

```php
AwemaAuth::routes();
```

You can disable registration:

```php
AwemaAuth::routes(['register' => false]);
```

Package will register several routes:

```
+--------+----------------------------------------+--------------------------+--------------------------+----------------------------------------------------------------------+--------------------------------------------------------+
| Domain | Method                                 | URI                      | Name                     | Action                                                               | Middleware                                             |
+--------+----------------------------------------+--------------------------+--------------------------+----------------------------------------------------------------------+--------------------------------------------------------+
|        | GET|HEAD                               | email/resend             | verification.resend      | AwemaPL\Auth\Controllers\VerificationController@resend                | web,throttle:1,0.2,auth,throttle:6,1                   |
|        | POST                                   | email/verify             | verification.code.verify | AwemaPL\Auth\Controllers\VerificationController@verifyCode            | web,auth                                               |
|        | GET|HEAD                               | email/verify             | verification.code        | AwemaPL\Auth\Controllers\VerificationController@show                  | web,auth                                               |
|        | GET|HEAD                               | email/verify/{id}        | verification.verify      | AwemaPL\Auth\Controllers\VerificationController@verify                | web,auth,signed,throttle:6,1                           |
|        | POST                                   | login                    |                          | AwemaPL\Auth\Controllers\LoginController@login                        | web,guest                                              |
|        | GET|HEAD                               | login                    | login                    | AwemaPL\Auth\Controllers\LoginController@showLoginForm                | web,guest                                              |
|        | POST                                   | login/twofactor/verify   | login.twofactor.verify   | AwemaPL\Auth\Controllers\TwoFactorLoginController@verify              | web,guest                                              |
|        | GET|HEAD                               | login/twofactor/verify   | login.twofactor.index    | AwemaPL\Auth\Controllers\TwoFactorLoginController@index               | web,guest                                              |
|        | GET|HEAD                               | login/{service}          | login.social             | AwemaPL\Auth\Controllers\SocialLoginController@redirect               | web,guest,AwemaPL\Auth\Middlewares\SocialAuthentication |
|        | GET|HEAD                               | login/{service}/callback |                          | AwemaPL\Auth\Controllers\SocialLoginController@callback               | web,guest,AwemaPL\Auth\Middlewares\SocialAuthentication |
|        | GET|HEAD|POST|PUT|PATCH|DELETE|OPTIONS | logout                   | logout                   | AwemaPL\Auth\Controllers\LoginController@logout                       | web                                                    |
|        | POST                                   | password/email           | password.email           | AwemaPL\Auth\Controllers\ForgotPasswordController@sendResetLinkEmail  | web,guest                                              |
|        | POST                                   | password/reset           | password.update          | AwemaPL\Auth\Controllers\ResetPasswordController@reset                | web,guest                                              |
|        | GET|HEAD                               | password/reset           | password.request         | AwemaPL\Auth\Controllers\ForgotPasswordController@showLinkRequestForm | web,guest                                              |
|        | GET|HEAD                               | password/reset/{token}   | password.reset           | AwemaPL\Auth\Controllers\ResetPasswordController@showResetForm        | web,guest                                              |
|        | POST                                   | register                 |                          | AwemaPL\Auth\Controllers\RegisterController@register                  | web,guest                                              |
|        | GET|HEAD                               | register                 | register                 | AwemaPL\Auth\Controllers\RegisterController@showRegistrationForm      | web,guest                                              |
|        | GET|HEAD                               | twofactor                | twofactor.index          | AwemaPL\Auth\Controllers\TwoFactorController@index                    | web,auth                                               |
|        | POST                                   | twofactor                | twofactor.store          | AwemaPL\Auth\Controllers\TwoFactorController@store                    | web,auth                                               |
|        | DELETE                                 | twofactor                | twofactor.destroy        | AwemaPL\Auth\Controllers\TwoFactorController@destroy                  | web,auth                                               |
|        | POST                                   | twofactor/verify         | twofactor.verify         | AwemaPL\Auth\Controllers\TwoFactorController@verify                   | web,auth                                               |
+--------+----------------------------------------+--------------------------+--------------------------+----------------------------------------------------------------------+--------------------------------------------------------+
```

Besides default authentication routes, it will add:

```php
# Socialite routes
'login.social'
'login/{service}/callback'

# Two factor authentication setup routes
'twofactor.index', 'twofactor.store', 'twofactor.destroy', 'twofactor.verify'

# Two factor authentication login routes
'login.twofactor.index', 'login.twofactor.verify'

# Email verification routes
'verification.resend', 'verification.code.verify', 'verification.code', 'verification.verify'
```

## Testing

You can run the tests with:

```bash
composer test
```