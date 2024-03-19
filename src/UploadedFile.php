<?php

namespace ViragHttpFoundation;

class UploadedFile
{
    protected $name;
    protected $type;
    protected $tmpName;
    protected $error;
    protected $size;

    public function __construct(string $name, string $type, string $tmpName, int $error, int $size)
    {
        $this->name = $name;
        $this->type = $type;
        $this->tmpName = $tmpName;
        $this->error = $error;
        $this->size = $size;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTmpName(): string
    {
        return $this->tmpName;
    }

    public function getError(): int
    {
        return $this->error;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function move(string $destination): bool
    {
        return move_uploaded_file($this->tmpName, $destination);
    }

    public function getExtension(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    public function getUploadedFiles(): array
    {
        return $_FILES;
    }

    public function hasError(): bool
    {
        return $this->error !== UPLOAD_ERR_OK;
    }

    public function getErrorMessage(): string
    {
        switch ($this->error) {
            case UPLOAD_ERR_INI_SIZE:
                return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
            case UPLOAD_ERR_FORM_SIZE:
                return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
            case UPLOAD_ERR_PARTIAL:
                return 'The uploaded file was only partially uploaded';
            case UPLOAD_ERR_NO_FILE:
                return 'No file was uploaded';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing a temporary folder';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Failed to write file to disk';
            case UPLOAD_ERR_EXTENSION:
                return 'A PHP extension stopped the file upload';
            default:
                return 'Unknown error';
        }
    }

    public function isImage(): bool
    {
        return strpos($this->type, 'image') === 0;
    }

    public function isText(): bool
    {
        return strpos($this->type, 'text') === 0;
    }

    public function isPDF(): bool
    {
        return $this->type === 'application/pdf';
    }

    public function isDocument(): bool
    {
        return strpos($this->type, 'application/msword') === 0 || strpos($this->type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') === 0;
    }

    public function isExcel(): bool
    {
        return strpos($this->type, 'application/vnd.ms-excel') === 0 || strpos($this->type, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') === 0;
    }

    public function isPowerPoint(): bool
    {
        return strpos($this->type, 'application/vnd.ms-powerpoint') === 0 || strpos($this->type, 'application/vnd.openxmlformats-officedocument.presentationml.presentation') === 0;
    }

    public function isArchive(): bool
    {
        return strpos($this->type, 'application/zip') === 0 || strpos($this->type, 'application/x-rar-compressed') === 0 || strpos($this->type, 'application/x-tar') === 0;
    }

    public function isAudio(): bool
    {
        return strpos($this->type, 'audio') === 0;
    }

    public function isVideo(): bool
    {
        return strpos($this->type, 'video') === 0;
    }

    public function isExecutable(): bool
    {
        return strpos($this->type, 'application/x-msdownload') === 0;
    }

    public function isCompressed(): bool
    {
        return strpos($this->type, 'application/gzip') === 0 || strpos($this->type, 'application/x-gzip') === 0 || strpos($this->type, 'application/x-bzip2') === 0 || strpos($this->type, 'application/x-compressed') === 0;
    }

    public function moveToDirectory(string $directory): bool
    {
        $destination = rtrim($directory, '/') . '/' . $this->name;
        return $this->move($destination);
    }

    public function getMimeType(): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $this->tmpName);
        finfo_close($finfo);
        return $mimeType;
    }

    public function getExtensionByMimeType(): string
    {
        $mimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/bmp' => 'bmp',
        ];

        $mimeType = $this->getMimeType();

        return $mimeTypes[$mimeType] ?? '';
    }

    public function isValid(): bool
    {
        return $this->error === UPLOAD_ERR_OK && is_uploaded_file($this->tmpName);
    }

    public function getSizeInKB(): float
    {
        return round($this->size / 1024, 2);
    }

    public function getSizeInMB(): float
    {
        return round($this->size / (1024 * 1024), 2);
    }
}
