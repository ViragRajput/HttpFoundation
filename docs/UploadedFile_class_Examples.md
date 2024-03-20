## File Upload Handling

### Handle File Upload and Move to Destination Directory

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
$destinationDirectory = 'uploads/';
if ($file->isValid()) {
    if ($file->move($destinationDirectory . $file->getName())) {
        echo 'File uploaded successfully.';
    } else {
        echo 'Failed to move file.';
    }
} else {
    echo 'Invalid file.';
}
```

### Determine File Extension

```php
use ViragHttpFoundation\UploadedFile;

// Assuming $file is an instance of UploadedFile
$extension = $file->getExtension();
echo 'File extension: ' . $extension;
```

### Check if Uploaded File is an Image

```php
use ViragHttpFoundation\UploadedFile;

// Assuming $file is an instance of UploadedFile
if ($file->isImage()) {
    echo 'Uploaded file is an image.';
} else {
    echo 'Uploaded file is not an image.';
}
```

### Get MIME Type of Uploaded File

```php
use ViragHttpFoundation\UploadedFile;

// Assuming $file is an instance of UploadedFile
$mimeType = $file->getMimeType();
echo 'MIME type: ' . $mimeType;
```

### Check if Uploaded File is Valid

```php
use ViragHttpFoundation\UploadedFile;

// Assuming $file is an instance of UploadedFile
if ($file->isValid()) {
    echo 'Uploaded file is valid.';
} else {
    echo 'Uploaded file is not valid.';
}
```
