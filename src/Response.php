<?php

namespace ViragHttpFoundation;

class Response
{
    protected $headers;
    protected $content;
    protected $statusCode;
    protected $protocol;

    public function __construct(string $content = '', int $statusCode = 200, array $headers = [], string $protocol = 'HTTP/1.1')
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->protocol = $protocol;
    }

    public function send(): void
    {
        // Send headers
        foreach ($this->headers as $header => $value) {
            header("$header: $value", true, $this->statusCode);
        }

        // Send content
        echo $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode, string $reasonPhrase = ''): void
    {
        if ($reasonPhrase === '' && isset(Response::$statusTexts[$statusCode])) {
            $reasonPhrase = Response::$statusTexts[$statusCode];
        }

        $this->statusCode = $statusCode;
        $this->setHeader($this->protocol . ' ' . $statusCode . ' ' . $reasonPhrase);
    }

    private static $statusTexts = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Too Early',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];

    public function setHeader(string $header, string $value = ''): void
    {
        $this->headers[$header] = $value;
    }

    public function addHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    public function setJsonContent(array $data): void
    {
        $this->setContent(json_encode($data));
        $this->setHeader('Content-Type', 'application/json');
    }

    public function setHtmlContent(string $html): void
    {
        $this->setContent($html);
        $this->setHeader('Content-Type', 'text/html');
    }

    public function redirect(string $url, int $statusCode = 302): void
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Location', $url);
    }

    public function addCookie(string $name, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = true): void
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    public function setCacheControl(string $value): void
    {
        $this->setHeader('Cache-Control', $value);
    }

    public function setXmlContent(string $xml): void
    {
        $this->setContent($xml);
        $this->setHeader('Content-Type', 'application/xml');
    }

    public function setContentType(string $contentType): void
    {
        $this->setHeader('Content-Type', $contentType);
    }

    public function setCustomHeaders(array $headers): void
    {
        foreach ($headers as $header => $value) {
            $this->setHeader($header, $value);
        }
    }

    public function setStatusMessage(string $message): void
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $this->statusCode . ' ' . $message, true, $this->statusCode);
    }

    public function setTextContent(string $text): void
    {
        $this->setContent($text);
        $this->setHeader('Content-Type', 'text/plain');
    }

    public function setCsvContent(array $data): void
    {
        $output = fopen('php://output', 'w');
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        $this->setHeader('Content-Type', 'text/csv');
    }

    public function setStatusCodeWithReason(int $statusCode, string $reasonPhrase): void
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $statusCode . ' ' . $reasonPhrase, true, $statusCode);
        $this->statusCode = $statusCode;
    }

    public function setJavaScriptContent(string $script): void
    {
        $this->setContent($script);
        $this->setHeader('Content-Type', 'application/javascript');
    }

    public function setPdfContent(string $pdfData): void
    {
        $this->setContent($pdfData);
        $this->setHeader('Content-Type', 'application/pdf');
    }

    public function setHtmlUtf8Content(string $html): void
    {
        $this->setContent($html);
        $this->setHeader('Content-Type', 'text/html; charset=utf-8');
    }

    public function setCssContent(string $css): void
    {
        $this->setContent($css);
        $this->setHeader('Content-Type', 'text/css');
    }

    public function setTextUtf8Content(string $text): void
    {
        $this->setContent($text);
        $this->setHeader('Content-Type', 'text/plain; charset=utf-8');
    }

    public function sendHeaders(): void
    {
        // Send headers
        foreach ($this->headers as $header => $value) {
            header("$header: $value", true, $this->statusCode);
        }
    }

    public function sendContent(): void
    {
        echo $this->content;
    }

    public function setPlainTextContent(string $text): void
    {
        $this->setContent($text);
        $this->setHeader('Content-Type', 'text/plain');
    }

    public function setJsonResponse(array $data, int $statusCode = 200, array $headers = []): void
    {
        $this->setJsonContent($data);
        $this->setStatusCode($statusCode);
        $this->addHeaders($headers);
    }

    public function setHtmlResponse(string $html, int $statusCode = 200, array $headers = []): void
    {
        $this->setHtmlContent($html);
        $this->setStatusCode($statusCode);
        $this->addHeaders($headers);
    }

    public function setRedirectResponse(string $url, int $statusCode = 302, array $headers = []): void
    {
        $this->redirect($url, $statusCode);
        $this->addHeaders($headers);
    }

    public function setCookieResponse(string $name, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = true): void
    {
        $this->addCookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    public function setXmlResponse(string $xml, int $statusCode = 200, array $headers = []): void
    {
        $this->setXmlContent($xml);
        $this->setStatusCode($statusCode);
        $this->addHeaders($headers);
    }

    public function setJavaScriptResponse(string $script, int $statusCode = 200, array $headers = []): void
    {
        $this->setJavaScriptContent($script);
        $this->setStatusCode($statusCode);
        $this->addHeaders($headers);
    }

    public function setNotFoundResponse(string $message = 'Not Found'): void
    {
        $this->setContent($message);
        $this->setStatusCode(404);
    }

    public function setInternalServerErrorResponse(string $message = 'Internal Server Error'): void
    {
        $this->setContent($message);
        $this->setStatusCode(500);
    }

    public function setForbiddenResponse(string $message = 'Forbidden'): void
    {
        $this->setContent($message);
        $this->setStatusCode(403);
    }

    public function setUnauthorizedResponse(string $message = 'Unauthorized'): void
    {
        $this->setContent($message);
        $this->setStatusCode(401);
    }

    public function setMethodNotAllowedResponse(string $message = 'Method Not Allowed'): void
    {
        $this->setContent($message);
        $this->setStatusCode(405);
    }

    public function setBadRequestResponse(string $message = 'Bad Request'): void
    {
        $this->setContent($message);
        $this->setStatusCode(400);
    }

    public function setNoContentResponse(): void
    {
        $this->setContent('');
        $this->setStatusCode(204);
    }

    public function setRedirectResponsePermanent(string $url, array $headers = []): void
    {
        $this->redirect($url, 301);
        $this->addHeaders($headers);
    }

    public function setTemporaryRedirectResponse(string $url, array $headers = []): void
    {
        $this->redirect($url, 307);
        $this->addHeaders($headers);
    }

    public function setGoneResponse(string $message = 'Gone'): void
    {
        $this->setContent($message);
        $this->setStatusCode(410);
    }

    public function setNotModifiedResponse(): void
    {
        $this->setContent('');
        $this->setStatusCode(304);
    }

    public function setServiceUnavailableResponse(string $message = 'Service Unavailable'): void
    {
        $this->setContent($message);
        $this->setStatusCode(503);
    }

    public function setJsonUtf8Content(array $data): void
    {
        $this->setContent(json_encode($data, JSON_UNESCAPED_UNICODE));
        $this->setHeader('Content-Type', 'application/json; charset=utf-8');
    }

    public function setXmlUtf8Content(string $xml): void
    {
        $this->setContent($xml);
        $this->setHeader('Content-Type', 'application/xml; charset=utf-8');
    }
}
