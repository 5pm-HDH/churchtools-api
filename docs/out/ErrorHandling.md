# Error Handling

The Error-Handling-Concept divides an exception in five different categories:

## CTConfigException

- wrong Configuration (e.q. no API-Url is set)

## CTModelException

- exception in model (e.q. process wiki-pages return root node)

## CTRequestException

- could not retrieve the models

### CTConnectException extends CTRequestException

- technical Exception the ConnectException from Guzzle
- error in Connection (timeout, undefined-host, ...)

### CTAuthException extends CTRequestException

- could not authenticate user

### CTPermissionException extends CTRequestException

- unauthorized access to resource (401)
- forbidden api-call (403)
