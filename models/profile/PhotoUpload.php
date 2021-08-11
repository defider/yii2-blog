<?php

namespace app\models\profile;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PhotoUpload extends Model{

    public $photo;

    public function rules()
    {
        return [
            [['photo'], 'required'],
            [['photo'], 'file', 'extensions' => 'jpg, png']
        ];
    }


    public function uploadFile(UploadedFile $file, $currentPhoto)
    {
        $this->photo = $file;

        if ($this->validate()) {
            $this->deleteCurrentPhoto($currentPhoto);

            return $this->savePhoto();
        }
        return false;
    }

    private function getFolder()
    {
        return Yii::getAlias('@web') . 'photos/';
    }

    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->photo->baseName)) . '.' . $this->photo->extension);
    }

    public function deleteCurrentPhoto($currentPhoto)
    {
        if ($this->fileExists($currentPhoto)) {
            unlink($this->getFolder() . $currentPhoto);
        }
    }

    public function fileExists($currentPhoto)
    {
        if (!empty($currentPhoto) && $currentPhoto != null) {
            return file_exists($this->getFolder() . $currentPhoto);
        }
        return false;
    }

    public function savePhoto()
    {
        $filename = $this->generateFilename();
        $this->photo->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}
