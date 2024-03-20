## Request Handling

### Create Request Object from Globals

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Get request method
$method = $request->getMethod();

// Get request URI
$uri = $request->getUri();

// Get request body
$body = $request->getRequestBody();

// Get request parameters
$parameters = $request->getParameters();

// Get request headers
$headers = $request->getHeaders();
```

### Check if Request is AJAX

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Check if request is AJAX
if ($request->isAjax()) {
    echo 'AJAX request detected.';
} else {
    echo 'Not an AJAX request.';
}
```

### Check if Request is Secure (HTTPS)

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Check if request is secure (HTTPS)
if ($request->isSecure()) {
    echo 'Secure (HTTPS) request detected.';
} else {
    echo 'Not a secure (HTTPS) request.';
}
```

### Get Client IP Address

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Get client IP address
$clientIp = $request->getClientIp();
echo 'Client IP address: ' . $clientIp;
```

### Check if Request is from Localhost

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Check if request is from localhost
if ($request->isFromLocalhost()) {
    echo 'Request is from localhost.';
} else {
    echo 'Request is not from localhost.';
}
```
### Get Request Method

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Get request method
$method = $request->getMethod();
echo 'Request method: ' . $method;
```

### Get Request URI

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Get request URI
$uri = $request->getUri();
echo 'Request URI: ' . $uri;
```

### Get Request Path

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Get request path
$path = $request->getPath();
echo 'Request path: ' . $path;
```

### Get Request Body

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Get request body
$body = $request->getRequestBody();
echo 'Request body: ' . $body;
```

### Check if Request is GET

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Check if request is GET
if ($request->isGet()) {
    echo 'GET request detected.';
} else {
    echo 'Not a GET request.';
}
```

### Check if Request is POST

```php
use ViragHttpFoundation\Request;

// Create request object from global variables
$request = Request::createFromGlobals();

// Check if request is POST
if ($request->isPost()) {
    echo 'POST request detected.';
} else {
    echo 'Not a POST request.';
}
```
