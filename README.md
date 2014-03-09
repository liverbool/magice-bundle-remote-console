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
## see also: https://github.com/phpconsole/phpconsole#configuration
magice_remote_console:
    projects: #required
        projectName1    : ProjectKey1
        projectName2    : ProjectKey2
        ...             : ...
    default_project: projectName1 #optional
    context_size: 20 #optional
```

### Usage
#### 1. Via container
```php
$this->get('console')->push($data, [projectName]);
// or
$this->container->get('console')->push($data, [projectName]);
```

#### 2. Via static
```php
use Magice\Bundle\RemoteConsoleBundle\Console;
.....
Console::push($data, [projectName]);
Console::info($data, [projectName]);
Console::success($data, [projectName]);
Console::error($data, [projectName]);
Console::trace(\Exception $exception, [projectName]);
```
