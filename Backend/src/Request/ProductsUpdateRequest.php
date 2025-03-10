<?php


declare(strict_types=1);

namespace App\Request;

use Phalcon\Http\Request;

class ProductsUpdateRequest extends AbstractRequest
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->validate($request);
    }

    public function validate($request): void
    {
        if ($request->hasFiles()) {
            $filePaths = [];
            $uploadedFiles = $request->getUploadedFiles();

            foreach ($uploadedFiles as $file) {
                if (
                    $file->getError() === 0 &&
                    $file->getExtension() === 'png' ||
                    $file->getExtension() === 'jpg' ||
                    $file->getExtension() === 'jpeg'
                ) {
                    $filePath = 'images/products/' . $file->getName();
                    $file->moveTo($filePath);
                    $filePaths[] = $filePath;
                } else {
                    $this->errors['image'] = 'Ошибка при загрузке файла';
                }
            }
            $this->data['image'] = json_encode($filePaths);
        }
    }
}
