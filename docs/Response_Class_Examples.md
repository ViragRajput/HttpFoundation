## Response Handling 

### Basic Response Creation and Sending

```php
use ViragHttpFoundation\Response;

// Create a response with a simple message
$response = new Response('Hello, world!', 200);

// Send the response
$response->send();
```

### Setting Content and Status Code

```php
use ViragHttpFoundation\Response;

// Create a response with custom content and status code
$response = new Response('<h1>Error 404: Page Not Found</h1>', 404);

// Send the response
$response->send();
```

### Setting JSON Response

```php
use ViragHttpFoundation\Response;

// Create a JSON response
$data = ['name' => 'John', 'age' => 30];
$response = new Response();
$response->setJsonContent($data);

// Send the JSON response
$response->send();
```

### Setting HTML Response

```php
use ViragHttpFoundation\Response;

// Create an HTML response
$html = '<html><body><h1>Welcome to My Website</h1></body></html>';
$response = new Response();
$response->setHtmlContent($html);

// Send the HTML response
$response->send();
```

### Redirect Response

```php
use ViragHttpFoundation\Response;

// Create a redirect response
$response = new Response();
$response->redirect('https://example.com', 302);

// Send the redirect response
$response->send();
```

### Adding Custom Headers

```php
use ViragHttpFoundation\Response;

// Create a response with custom headers
$response = new Response();
$response->setHeader('Content-Type', 'text/plain');
$response->setHeader('X-Custom-Header', 'Custom Value');

// Send the response
$response->send();
```

### Setting Cookies

```php
use ViragHttpFoundation\Response;

// Create a response with a cookie
$response = new Response();
$response->addCookie('user_id', '123', time() + 3600, '/', '', false, true);

// Send the response
$response->send();
```

### Setting Cache Control

```php
use ViragHttpFoundation\Response;

// Create a response with cache control
$response = new Response();
$response->setCacheControl('max-age=3600, must-revalidate');

// Send the response
$response->send();
```
