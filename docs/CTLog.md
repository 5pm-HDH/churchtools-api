# CTLog

By default, there are two log types:

**File-Log:**

- Logs the log-levels: INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
- Log is stored to the file `churchtools-api.log`

**Console-Log:**

- Logs by default the log-level: ERROR, CRITICAL, ALERT, EMERGENCY
- Log is displayed to the php-console

## Enable / disable

Both file-log and console-log is enabled by default. To disable and (re-)enable you can use:

```php
use CTApi\CTLog;

// enable
CTLog::enableFileLog();
CTLog::enableConsoleLog();

// alternative enabling
CTLog::enableFileLog(true);
CTLog::enableConsoleLog(true);

// disable log
CTLog::enableFileLog(false);
CTLog::enableConsoleLog(false);
```

## Set log-level

Only the loglevel of the console-log can be changed:

```php 
// reacts to log-levels: ERROR, CRITICAL, ALERT, EMERGENCY
// is default setting
CTLog::setConsoleLogLevelError();

// logs all available log-levels: DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
CTLog::setConsoleLogLevelDebug();
```

## Log messages

With the `getLog`-method you can get the Logger an use all log-methods defined
in [PSR-3](https://www.php-fig.org/psr/psr-3/):

```php
use CTApi\CTLog;

CTLog::getLog()->debug("...");

CTLog::getLog()->info("...");

CTLog::getLog()->notice("...");

CTLog::getLog()->warning("...");

CTLog::getLog()->error("...");

CTLog::getLog()->critical("...");

CTLog::getLog()->alert("...");

CTLog::getLog()->emergency("...");

```
