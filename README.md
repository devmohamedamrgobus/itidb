#  Iti DB 

iti DB is a small php wrapper for mysql databases.

## installation

install once with composer:

```
composer require iti/db
```

then add this to your project:

```php
require __DIR__ . '/vendor/autoload.php';
use Iti\Db\db;
$db = new db();
```

## usage

```php
/* connect to database */
include 'vendor/autoload.php';

use Iti\Db\db;

$DB = new db('localhost','root','','iti');
print_r($DB->table('category')->select()->all());

```

