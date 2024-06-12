# add polls to your laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bataboom/pollsbb.svg?style=flat-square)](https://packagist.org/packages/bataboom/pollsbb)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bataboom/pollsbb/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bataboom/pollsbb/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/bataboom/pollsbb/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/bataboom/pollsbb/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bataboom/pollsbb.svg?style=flat-square)](https://packagist.org/packages/bataboom/pollsbb)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/PollsBB.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/PollsBB)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require bataboom/pollsbb
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="pollsbb-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="pollsbb-config"
```

This is the contents of the published config file:

```php
return [
    'user_model' => App\Models\User::class,
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="pollsbb-views"
```

## Usage

```php

<x-app-layout>

<livewire:create-poll />
@php
$findPoll = \BataBoom\PollsBB\Models\Poll::all()->first();
@endphp

<livewire:view-poll :poll="$findPoll" />

</x-app-layout>

after create-poll is created it should auto redirect to view-poll but WIP, upgrading emit/etc from Livewire v2 to v3. 
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [BataBoom](https://github.com/BataBoom)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
