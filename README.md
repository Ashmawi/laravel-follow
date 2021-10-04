# Laravel Follow

## Installing
```
$ composer require ashmawi/laravel-follow
```
```
$ php artisan migrate
```

## Configuration
This step is optional
```
$ php artisan vendor:publish --tag=laravel-follow-config
```

## Migrations
This step is also optional, if you want to custom the pivot table, you can publish the migration files
```
$ php artisan vendor:publish --tag=laravel-follow-migrations
```

## Usage

### Traits

```php
use Ashmawi\LaravelFollow\Traits\Followable;

class User extends Authenticatable
{
    use Followable;
}
```

### API

```php
$user1->follow($user2);
$user1->unfollow($user2);

$user1->isFollowing($user2)
```

### Get followings
```php
$user->followings
```

### Get followers
```php
$user->followers
```

### Aggregations

```php
// followings count
$user->followings()->count();

// with query where
$user->followings()->where('x', 'x')->count();

// followers count
$user->followers()->count();
```



