# Virag HTTPFoundation

HTTPFoundation is a PHP package designed to provide a set of classes for handling HTTP-related tasks, including handling cookies, sessions, file uploads, generating HTTP responses, and processing HTTP requests. This package aims to simplify common HTTP-related operations in PHP web development.

## Features

- **Cookie Handling**: Easily manage HTTP cookies with the `Cookie` class, including setting, getting, deleting, and encrypting/decrypting cookie values.
- **Session Management**: Handle PHP sessions effortlessly with the `Session` class, allowing setting, getting, checking existence, and removing session data.
- **File Upload Handling**: Manage file uploads with the `UploadedFile` class, including retrieving file information, moving uploaded files, and determining file types.
- **HTTP Response Generation**: Generate HTTP responses dynamically with the `Response` class, allowing setting status codes, headers, and response content easily.
- **HTTP Request Processing**: Process incoming HTTP requests with the `Request` class, enabling access to request headers, parameters, and files.

## Installation

You can install the HTTPFoundation package via [Composer](https://getcomposer.org/):

```bash
composer require viragrajput/http-foundation
```

## Usage

### Cookie Handling

```php
use Virag\HttpFoundation\Cookie;

// Set a cookie
Cookie::set('username', 'john_doe', time() + 3600, '/', 'example.com', true, true);

// Get a cookie value
$username = Cookie::get('username');

// Delete a cookie
Cookie::delete('username');
```

### Session Management

```php
use Virag\HttpFoundation\Session;

// Start a session
$session = new Session();

// Set session data
$session->set('user_id', 123);

// Get session data
$userID = $session->get('user_id');

// Regenerate session ID
$session->regenerateId();
```

### File Upload Handling

```php
use Virag\HttpFoundation\UploadedFile;

// Handle file upload
$file = new UploadedFile(
    $_FILES['file']['name'],
    $_FILES['file']['type'],
    $_FILES['file']['tmp_name'],
    $_FILES['file']['error'],
    $_FILES['file']['size']
);

// Move uploaded file to destination directory
$file->move('uploads/');
```
For more details example of this class, please check docs folder.

### HTTP Response Generation

```php
use Virag\HttpFoundation\Response;

// Create a response with JSON content
$response = new Response();
$response->setJsonResponse(['message' => 'Success'], 200);
$response->send();

// Create a response with HTML content
$htmlContent = "<html><body><h1>Hello, World!</h1></body></html>";
$response = new Response();
$response->setHtmlResponse($htmlContent, 200);
$response->send();

// Create a redirect response
$response = new Response();
$response->setRedirectResponse('/new-page', 302);
$response->send();

// Create a response with custom headers
$response = new Response();
$response->setHtmlResponse('Custom Content', 200);
$response->setHeader('X-Custom-Header', 'Value');
$response->send();

// Create a response with an error message
$response = new Response();
$response->setBadRequestResponse('Bad Request');
$response->send();
```

### HTTP Request Processing

The `createFromGlobals` method creates a `Request` object based on the global variables available in PHP, such as `$_SERVER`, `$_REQUEST`, and `php://input`. This method is convenient for creating request objects in a standardized way, especially in web applications where requests are typically handled through the global scope.

```php
use Virag\HttpFoundation\Request;

// Create a request object from global variables
$request = Request::createFromGlobals();

// Now you can access various properties and methods of the $request object
$method = $request->getMethod();
$uri = $request->getUri();
$params = $request->getParameters();
$headers = $request->getHeaders();
```

## Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request for any improvements or bug fixes.

## License

This package is open-source software licensed under the [MIT License](LICENSE).
