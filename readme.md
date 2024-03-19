# ViragHTTPFoundation

ViragHTTPFoundation is a PHP package designed to provide a set of classes for handling HTTP-related tasks, including handling cookies, sessions, file uploads, generating HTTP responses, and processing HTTP requests. This package aims to simplify common HTTP-related operations in PHP web development.

## Features

- **Cookie Handling**: Easily manage HTTP cookies with the `Cookie` class, including setting, getting, deleting, and encrypting/decrypting cookie values.
- **Session Management**: Handle PHP sessions effortlessly with the `Session` class, allowing setting, getting, checking existence, and removing session data.
- **File Upload Handling**: Manage file uploads with the `UploadedFile` class, including retrieving file information, moving uploaded files, and determining file types.
- **HTTP Response Generation**: Generate HTTP responses dynamically with the `Response` class, allowing setting status codes, headers, and response content easily.
- **HTTP Request Processing**: Process incoming HTTP requests with the `Request` class, enabling access to request headers, parameters, and files.

## Installation

You can install the ViragHTTPFoundation package via [Composer](https://getcomposer.org/):

```bash
composer require viragrajput/viraghttpfoundation
```

## Usage

### Cookie Handling

```php
use ViragHttpFoundation\Cookie;

// Set a cookie
Cookie::set('username', 'john_doe', time() + 3600, '/', 'example.com', true, true);

// Get a cookie value
$username = Cookie::get('username');

// Delete a cookie
Cookie::delete('username');
```

### Session Management

```php
use ViragHttpFoundation\Session;

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
use ViragHttpFoundation\UploadedFile;

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

### HTTP Response Generation

```php
use ViragHttpFoundation\Response;

// Create a response
$response = new Response('Hello, World!', 200, ['Content-Type' => 'text/plain']);

// Send the response
$response->send();
```

### HTTP Request Processing

```php
use ViragHttpFoundation\Request;

// Create a request object
$request = new Request();

// Get request method
$method = $request->getMethod();

// Get request URI
$uri = $request->getRequestUri();

// Get request parameters
$params = $request->getParams();

// Get request headers
$headers = $request->getHeaders();
```

## Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request for any improvements or bug fixes.

## License

This package is open-source software licensed under the [MIT License](LICENSE).
