<?php

namespace app\models;


use Imagine\Image\Box;
use Yii;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class imagesUpload extends Model
{
    public $images;
    public $image;

    public function rules()
    {
        return [
            [['images'], 'file', 'extensions' => 'jpg', 'mimeTypes' => 'image/jpeg', 'maxFiles' => 10, 'maxSize' => 2097152, 'skipOnEmpty' => true]
        ];
    }


    /**
     * @param string $path folder name for image uploading
     * @param UploadedFile[] $images array of images for upload
     * @param integer $productId
     */
    public function uploadImages($path, $images, $productId)
    {
        $watermark = Yii::getAlias('@webroot') . "/images/watermark.png";
        if ($this->validate() && !empty($images)) {
            $this->deleteImages($path, $productId);
                foreach ($images as $image) {
                    $this->image = $image;
                    $filename = $this->generateImageName();

//                    Set watermark size based   on current image size
                    $imageSize = getimagesize($image->tempName);
                    $wWidth = $imageSize[0] - 20;
                    $wHeight = $imageSize[1] / 2;

                    $watermarkImage = Image::getImagine()->open($watermark)->thumbnail(new Box($wWidth, $wHeight));
                    $wX = ($wWidth/2) - ($watermarkImage->getSize()->getWidth() / 2);
                    $wY = $wHeight - ($watermarkImage->getSize()->getHeight() / 2);

//                    Save image with watermark
                    Image::watermark($image->tempName, $watermarkImage, [$wX, $wY])->save($this->getFolder($path) . $filename);
//                    Add image to DB
                    $this->saveToDB($path, $filename, $productId);
                }

        }
    }

    /**
     * @param string $path image folder name
     *
     * @return string path to image folder (/path_to_folder/images/$path/)
     */
    private function getFolder($path)
    {
        return Yii::getAlias('@webroot') . "/images/" . $path . "/";
    }

    /**
     * @param string $path image folder name
     *
     * @return string website path to image (http://example.com/images/$path/)
     */
    public function getPath($path)
    {
        return Yii::getAlias('@images/' . $path . "/");
    }

    /**
     * Generates unique name for image
     *
     * @return string unique name for image
     */
    private function generateImageName()
    {
        return strtolower(md5(uniqid($this->image->basename)) . "." . $this->image->extension);
    }

    /**
     * Save image to DB
     *
     * @param string $group image folder
     * @param string $name unique image name
     * @param integer $productId product id
     */
    private function saveToDB($group, $name, $productId)
    {
        $image = new Images();
        $image->img_group = $group;
        $image->img_name = $name;
        $image->product_id = $productId;

        $image->save();
    }

    /**
     * Get list of images for product
     *
     * @param string $folder image folder
     * @param integer$product_id product id
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getImagesFromDB($folder, $product_id)
    {
        $images = Images::find()->where(['product_id' => $product_id, 'img_group'=>$folder])->all();
        return $images;
    }

    /**
     * Delete all images for calling product
     *
     * @param string $group image folder
     * @param integer $product_id product id
     */
    public function deleteImages($group, $product_id)
    {
        $images = $this->getImagesFromDB($group, $product_id);

        foreach ($images as $image) {
            if ($this->checkImage($group, $image->img_name)) {
                unlink($this->getFolder($group) . $image->img_name);
            }
        }
        Images::deleteAll(['product_id' => $product_id]);
    }

    /**
     * Checking if image file exists in folder
     *
     * @param string $group image folder
     * @param string $imgName unique image name
     *
     * @return bool
     */
    private function checkImage($group, $imgName)
    {
        if (!empty($imgName) && $imgName != null)
            return file_exists($this->getFolder($group) . $imgName);
        return false;
    }
}