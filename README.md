![Gif](https://i.imgur.com/C1aDJBs.gif)

## Installation

You can install the package via composer:

```bash
composer require bataboom/pollsbb:dev-main
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
