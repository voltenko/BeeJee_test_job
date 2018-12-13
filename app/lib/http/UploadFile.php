<?php

namespace app\lib\http;

use app\exceptions\UploadException;

/**
 * Обёртка загружаемого файла.
 * @package app\lib\http
 */
class UploadFile
{
    private $name;
    private $fileName;
    private $type;
    private $size;
    private $tmpName;
    private $error;
    private $uploadFile;

    /**
     * UploadFile constructor.
     * @param $name
     * @param $type
     * @param $size
     * @param $tmpName
     * @param $error
     */
    public function __construct($name, $type, $size, $tmpName, $error)
    {
        $basename       = basename($name);
        $this->name     = $basename;
        $this->fileName = $name;
        $this->type     = $type;
        $this->size     = $size;
        $this->tmpName  = $tmpName;
        $this->error    = $error;

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/' . \Constants::IMG_UPLOAD_DIR;
        $this->uploadFile = "{$uploadDir}/{$basename}";
    }


    /**
     * Загружаем файл, проверяем его тип и размер.
     * @param array $allowed
     * @param int $maxSize
     * @return bool
     * @throws UploadException
     */
    public function upload(array $allowed = ['gif','png' ,'jpg', 'jpeg'], int $maxSize = 5000000): bool
    {
        $ext = pathinfo($this->fileName, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            throw new UploadException(\Constants::FILE_TYPE_ERR);
        }

        if ($this->size > $maxSize) {
            throw new UploadException(\Constants::FILE_SIZE_ERR);
        }

        if (move_uploaded_file($this->tmpName, $this->uploadFile)) {
            return true;
        } else {
            throw new UploadException(\Constants::UPLOAD_ERR);
        }
    }


    /**
     * Возвращает имя файла
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * Возвращает тип файла.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


    /**
     * Возвращает размер файла.
     * @return string
     */
    public function getSize(): int
    {
        return $this->size;
    }


    /**
     * Возвращает код ошибки.
     * @return string
     */
    public function getError(): int
    {
        return $this->error;
    }
}