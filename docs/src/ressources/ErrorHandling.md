# Error Handling

The Error-Handling-Concept divides an exception in five different categories:

**CTConnectException**
- technical Exception the ConnectException from Guzzle
- error in Connection (timeout, undefined-host, ...)

**CTConfigException**
- wrong Configuration (e.q. no API-Url is set)

**CTAuthException**
- could not authenticate user
- unauthorized access to resource

**CTRequestException**
- could not retrieve the models

**CTModelException**
- exception in model (e.q. process wiki-pages return root node)