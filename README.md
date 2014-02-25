Phpconsole bundle for Symfony2
============================
See: http://phpconsole.com/

### Installation
```
$ php composer.phar require "magice/remote-console-bundle"
```
** version constraint requirement: `dev-master`

### Configuration
app/config/config.yml
```yaml
magice_remote_console:
    config:
        domain: your domain
        nickname: your name
        apikey: your api key
```

### Usage
#### 1. Via container
```php
$this->get('console')->push($data, [user]);
// or
$this->container->get('console')->push($data, [user]);
```

#### 2. Via static
```php
use Magice\Bundle\RemoteConsoleBundle\Console;
.....
Console::push($data, [user]);
```
