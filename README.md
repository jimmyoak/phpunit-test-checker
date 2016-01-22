# PHPUnit test checker



## Usage

Config file example (phpunit-test-checker.json):
```json
{
  "suites": [
    {
      "src-path": "src/",
      "test-path": "test/",
      "test-case-suffix": "Test"
    }
  ]
}
```

Read config and check for classes with no tests:
```php
use JimmyOak\PhpUnitChecker\Checker\Checker;

require_once __DIR__ . '/vendor/autoload.php';

$checker = new Checker(\JimmyOak\PhpUnitChecker\Config\JsonConfigReader::readFile(__DIR__ . '/phpunit-test-checker.json'));
$checker->check();
```

Output:
```text
Classes with no tests:
        - Checker/Checker.php
        - Command/CheckerCommand.php
```

But if we run with this config...:

```json
{
  "suites": [
    {
      "src-path": "src/",
      "test-path": "test/",
      "test-case-suffix": "Test",
      "excluded": [
        "Checker/Checker.php",
        "Command/"
      ]
    }
  ]
}
```

Outputs nothing :)

"Excluded" is just a regex like /^Command/, therefore if it's a folder put the / separator at the end. 

## TODO

A lot of improvements. This is only an approach. (Proof of concept)