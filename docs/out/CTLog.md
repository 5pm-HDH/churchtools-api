# CTLog

By default, there are three log types:

**File-Log (Info):**

- Logs the log-levels: INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
- Log is stored to the file `churchtools-api.log`

**File-Log (Warning):**

- Logs the log-levels: WARNING, ERROR, CRITICAL, ALERT, EMERGENCY
- Log is stored to the file `churchtools-api-warning.log`

**Console-Log:**

- Logs by default the log-level: ERROR, CRITICAL, ALERT, EMERGENCY
- Log is displayed to the php-console

**HTTP-Log**

- Stores all HTTP-Response Data in the folder `http-dump`.
- Enable with `CTLog::enableHttpLog();`

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
use CTApi\CTLog;

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

## How Log-levels are used in churchtools-api:

A log-message must contain the class where the log takes place. For
example: `CTConfig: Authenticate CTConfig with credentials.`

* **DEBUG** - technically information that helps to find bugs
    * log `get` / `post`-Request in CTClient
    * *Example message*: `CTClient: GET-Request URI:/api/persons/5132/logintoken {"options":[],"mergedOptions":[...]}`
* **INFO** - information that helps to identify what happened
    * log call of Request-Methods
    * *Example message*: `CTApi.INFO: AuthRequest: Authenticate CTConfig with credentials.`

* **NOTICE** - information of deprecated features or alternatives
* **WARNING** - information of possible fault
    * logs when a exception is created
    * *Example
      message*: `CTAuthException: Authentication was not successfully: Username or password wrong for some.wrong.email@wrong-provider.com`
* **ERROR** - error occurs
