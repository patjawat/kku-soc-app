<?php

namespace app\components;

use app\models\Uploads;
use Yii;
use yii\base\Component;
use yii\helpers\Html;

//use yii\helpers\Url;

/**
 * ฟังก์ชั่นสนับสนุนงานเอกสาร
 * @author suchart bunhachirat <suchartbu@gmail.com>
 */
class SystemHelper extends Component
{

    const UPLOAD_FOLDER = '../var/files';


    public static function initialDataSession()
    {

        \Yii::$app->session->set('data','');
        
    }
    public static function initialsetDataSession($ref)
    {
        $data = array_merge([
            'ref' => $ref
        ]);
        \Yii::$app->session->set('data', $data);
        
    }

    public static function dataSession()
    {
        // $data = array_merge([
        //     'ref' => $ref
        // ]);
       return  \Yii::$app->session->get('data');
        
    }

    
    /**
     * เตรียมเอกสาร HIMS เพื่อใช้งานในระบบ
     * @param type $hn
     * @return array
     */
    public static function getHimsEmr($hn)
    {
        $src = "/var/www/mount/hims-app/reg/" . $hn;
        $dst = "/var/www/mount/nas-tcds/hims-emr/" . $hn;
        if (is_dir($src)) {
            $hims_emr = new HimsEmr($src, $dst);
            return ['file_' => $hims_emr->file_, 'type_' => $hims_emr->type_];
        }
    }

    /**
     *
     * @param type $hn
     * @param type $file_path
     * @return type
     */
    public static function getImagePatientOpdVisit($patient_profile_path)
    {
        if (file_exists($patient_profile_path)) {
            $file_path = "index.php?r=document/default/image&file_path=$patient_profile_path&width=800&height=800";
            return Html::img($file_path, ['class' => 'profile-user-img', 'style' => 'width: 155px; height: 155px; object-fit: cover;', 'loading' => 'lazy']);
        }
        return null;
    }

    /**
     * รูปถ่ายผู้รับบริการล่าสุด
     * @param type $hn
     * @return string
     */
    public static function getImagePatientProfile($hn)
    {
        $file_path = self::getImagePatientProfilePath($hn);
        if (file_exists($file_path)) {
            $file_path = "index.php?r=document/default/image&file_path=$file_path&width=800&height=800";
            return Html::img($file_path, ['class' => 'profile-user-img', 'loading' => 'lazy']);
        } else {
            //$patient = HisPatient::findOne(['hn' => $hn]);
            $patient = HisPatient::findOne(['hn' => $hn]);
            return Html::img($patient->sex == 'F' ? '@web/img/woman.png' : '@web/img/boss.png', ['class' => 'profile-user-img', 'loading' => 'lazy']);
        }
    }

    /**
     * เส้นทางที่เก็บไฟล์รูปถ่ายผู้รับบริการล่าสุด
     * @param type $hn
     * @return string
     */
    public static function getImagePatientProfilePath($hn)
    {
        $model = Documentqr::find()->where(['hn' => $hn, 'document_qr_map_id' => 129, 'print' => '0'])->orderBy(['real_filename' => SORT_DESC, 'create_time' => SORT_DESC])->one();
        return $model ? self::getUploadPath() . $model->hn . '/' . $model->real_filename : null;
    }

    /**
     * Upload Preview Screen
     * chown www-data
     * ls -dl /var/www/mount/nas-tcds/tcds-emr/460028
     * @param int $hn
     * @param string $real_filename
     * @return string
     */

     

    public static function getFileUpload($id)
    {
        $model = Uploads::find()->where(['upload_id' => $id])->One();
        //self::setOwner(self::getUploadPath() . $hn);
        if ($model) {
            $file_path = self::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $file_ = pathinfo($file_path);
            if (file_exists($file_path)) {
                $file_path = "/soc/events/image?file_path=$file_path&width=100&height=100";
              
                if (strtolower($file_['extension']) == ('png' || 'jpg')) {
                    return Html::img($file_path, ['class' => 'file-preview-image', 'loading' => 'lazy']);
                }
                
  
            }
        }
        // if (file_exists($file_path)) {
        //     return $file_path;
        // $file_path = "/soc/events/image?file_path=$file_path&width=800&height=800";
        // return Html::img($file_path, ['class' => 'file-preview-image', 'loading' => 'lazy']);
        // }
        // return Html::img('@web/img/image-placeholder.png', ['class' => 'file-preview-image', 'loading' => 'lazy']);
    }

    public static function getImageUploadxx($id)
    {
        $model = Uploads::find()->where(['upload_id' => $id])->One();
        //self::setOwner(self::getUploadPath() . $hn);
        if ($model) {
            $file_path = self::getUploadPath() . $model->ref . '/' . $model->real_filename;
            $file_ = pathinfo($file_path);
            if (file_exists($file_path)) {
                $file_path = "/soc/events/image?file_path=$file_path&width=800&height=800";
                if (strtolower($file_['extension']) == 'png') {
                    return Html::img($file_path, ['class' => 'file-preview-image', 'loading' => 'lazy']);

                }
            }
        }
        // if (file_exists($file_path)) {
        //     return $file_path;
        // $file_path = "/soc/events/image?file_path=$file_path&width=800&height=800";
        // return Html::img($file_path, ['class' => 'file-preview-image', 'loading' => 'lazy']);
        // }
        // return Html::img('@web/img/image-placeholder.png', ['class' => 'file-preview-image', 'loading' => 'lazy']);
    }

    /**
     * แปลงไฟล์สำหรับใช้งาน
     * tcds ALL=(ALL) NOPASSWD: /usr/bin/chown, /usr/bin/php
     * www-data ALL =(ALL) NOPASSWD: /usr/bin/chown
     * tcds    ALL=(ALL) NOPASSWD:/bin/chown
     * www-data        ALL =(ALL) NOPASSWD:/bin/chown
     * @param string $file_path
     * @return \Imagick
     */


    public static function getFiles($file_path, int $width = 1080, int $height = 1080)
    {

        try {
            $file_ = pathinfo($file_path);
            if (self::isImage($file_path)) {
                // self::setOwner($file_path);
                return self::getResizeImage($file_path, $width, $height, \Imagick::FILTER_BOX, 1, true, false);
            }


            // self::setOwner($file_['dirname']);
            // if (EmrHelper::isDocHide($file_)) {
            //     $file_path = Yii::getAlias('@app/web/img/') . 'image-hide.png';
            //     return self::getResizeImage($file_path, $width, $height, \Imagick::FILTER_BOX, 1, true, false);
            // }
            // if (strtolower($file_['extension']) == 'pdf') {
            //     // self::setOwner($file_path);
            //     return self::getPdfImage($file_path);
            // }
            // if (self::isImage($file_path)) {
            //     // self::setOwner($file_path);
            //     return self::getResizeImage($file_path, $width, $height, \Imagick::FILTER_BOX, 1, true, false);
            // }
            // $file_path = Yii::getAlias('@app/web/img/') . 'image-placeholder.png';
            // return self::getResizeImage($file_path, $width, $height, \Imagick::FILTER_BOX, 1, true, false);
            // return strtolower($file_['extension']);

            return $file_ = pathinfo($file_path);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * chown www-data
     * @param string $file_path
     */
    private static function setOwner(string $file_path)
    {
        $output = null;
        $retval = null;
        $cmd = "sudo chown www-data $file_path";
        exec($cmd, $output, $retval);
        ($retval) ? die($cmd) : '';
    }

    /**
     * คืนค่าจริงถ้าเป็นเอกสารที่ไม่มีสิทธิดู
     * @param type $file_
     * @return boolean
     */
    public static function isDocHide($file_)
    {
        $segment_ = explode("-", $file_['basename']);
        return (\in_array($segment_[0], self::DOC_ID_HIDE) && !self::isCanShow()) ? true : false;
    }

    /**
     * คืนค่าจริงถ้าสามารถดูได้
     * @return boolean
     */
    public static function isCanShow()
    {
        foreach (self::CAN_ID_SHOW as $value) {
            if (\Yii::$app->user->can($value)) {
                return true;
            }
        }
        return false;
    }

    /**
     * คืนค่าจริงถ้าสามารถลบได้
     * @return boolean
     */
    public static function isCanDel()
    {
        foreach (self::CAN_ID_DEL as $value) {
            if (\Yii::$app->user->can($value)) {
                return true;
            }
        }
        return false;
    }

    /**
     * ปรับขนาดภาพ
     * @param string $file_path
     * @param int $width
     * @param int $height
     * @param int $filter_type
     * @param int $blur
     * @param boolean $best_fit
     * @param type $crop_zoom
     * @return \Imagick
     */
    public static function getResizeImage($file_path, $width, $height, $filter_type, $blur, $best_fit, $crop_zoom)
    {
        //The blur factor where > 1 is blurry, < 1 is sharp.
        try {
            $img = new \Imagick();
            $img->readimage($file_path);
            $img->resizeImage($width, $height, $filter_type, $blur, $best_fit);
            $cropWidth = $img->getImageWidth();
            $cropHeight = $img->getImageHeight();
            if ($crop_zoom) {
                $newWidth = $cropWidth / 2;
                $newHeight = $cropHeight / 2;
                $img->cropimage(
                    $newWidth, $newHeight, ($cropWidth - $newWidth) / 2, ($cropHeight - $newHeight) / 2
                );

                $img->scaleimage(
                    $img->getImageWidth() * 4, $img->getImageHeight() * 4
                );
            }
            $img->setImageFormat('jpeg');
            return $img;
        } catch (\ImagickException$ex) {

        }
    }

    /**
     * แปลง PDF เป็นภาพ
     * @param type $file_path
     * @return \Imagick
     */
    public static function getPdfImage($file_path)
    {
        try {
            if (file_exists($file_path)) {
                $img = new \Imagick();
                $img->setResolution(150, 150);
                $img->readimage($file_path . '[0]');
                $img->setImageFormat('png');
            }
            return $img;
        } catch (\ImagickException$exc) {
            //echo $exc->getTraceAsString();
        }
    }

    /**
     * เช็คความถูกต้องของไฟล์ภาพ
     * @param string $file_path
     * @return int
     */
    public static function isImage($file_path)
    {
        return file_exists($file_path) ? exif_imagetype($file_path) : false;
    }

    /**
     * ข้อมูลวันที่สร้างจากชื่อไฟล์
     * @param string $file_name
     * @return array
     */
    public static function getDateId($file_name)
    {
        $Y = substr($file_name, 0, 2);
        $M = substr($file_name, 2, 2);
        return ['Y' => $Y, 'M' => $M, 'D' => \substr($file_name, 4, 2), 'YY-MM' => $Y . '-' . $M];
    }

    /**
     * ที่เก็บอัพโหลดไฟล์
     * @return string
     */
    public static function getUploadPath()
    {
        return self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl()
    {
// return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
        return self::UPLOAD_FOLDER . '/';
    }

//ที่เก็บอัพโหลดไฟล์ยา
    public static function getUploadDrugPath()
    {
        return self::UPLOAD_FOLDER_DRUG . '/';
    }

    //ที่เก็บรูปภาwห้องผู้ป่วยนอก
    public static function getUploadRoomPath()
    {
        return self::UPLOAD_FOLDER_IPD_ROOM . '/';
    }

    /**
     * ข้อมูล thai cv risk ล่าสุด
     * @param string $hn
     * @return type
     */
    public static function getThaiCvRiskByHn(string $hn)
    {
        $sql = "SELECT * FROM `document_qr` WHERE `hn` = :hn AND `document_qr_map_id` = 96 ORDER BY `real_filename` DESC";
        return Yii::$app->tcds->createCommand($sql)
            ->bindValue(':hn', $hn)
            ->queryOne();
    }

    /**
     * วันที่ทำ thai cv risk ล่าสุด
     * @param string $hn
     * @return type
     */
    public static function getThaiCvRisk(string $hn)
    {
        $thai_cv_risk_ = self::getThaiCvRiskByHn($hn);
        return ($thai_cv_risk_) ? '<span style="font-size: 200%;">อัพโหลดครั้งล่าสุดเมื่อ : ' . $thai_cv_risk_['created_at'] . '</span>' : '<span style="font-size: 200%; color:OrangeRed;"> ยังไม่เคยทำแบบประเมิน</span>';
    }

    /**
     * ข้อมูล dm risk ล่าสุด
     * @param string $hn
     * @return type
     */
    public static function getDmRiskByHn(string $hn)
    {
        $sql = "SELECT * FROM `document_qr` WHERE `hn` = :hn AND `document_qr_map_id` = 95 ORDER BY `real_filename` DESC";
        return Yii::$app->tcds->createCommand($sql)
            ->bindValue(':hn', $hn)
            ->queryOne();
    }

    /**
     * วันที่ทำ dm risk ล่าสุด
     * @param string $hn
     * @return type
     */
    public static function getDmRisk(string $hn)
    {
        $dm_risk_ = self::getDmRiskByHn($hn);
        return ($dm_risk_) ? '<span style="font-size: 200%;">อัพโหลดครั้งล่าสุดเมื่อ : ' . $dm_risk_['created_at'] . '</span>' : '<span style="font-size: 200%; color:OrangeRed;"> ยังไม่เคยทำแบบประเมิน</span>';
    }

}

class HimsEmr
{

    public $file_ = [];
    public $type_ = [];

    public function __construct($src, $dst)
    {
        $this->setRecursiveCopy($src, $dst);
    }

    private function setRecursiveCopy($src, $dst)
    {
        $dir = opendir($src);
        $file_ = [];
        @mkdir($dst);
        while (($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->setRecursiveCopy($src . '/' . $file, $dst . '/' . $file);
                } else if (self::isImage($src . '/' . $file)) {
                    copy($src . '/' . $file, $dst . '/' . $file);
                    $info_ = pathinfo($dst);
                    $this->file_[$file] = ['type_id' => $info_['basename'], 'info_' => $info_];
                    array_push($file_, $file);
                    $this->type_[$info_['basename']] = $file_;
                }
            }
        }
        closedir($dir);
    }

}
