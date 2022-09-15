<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use app\components\SystemHelper;
use app\modules\soc\models\Events;

/**
 * This is the model class for table "uploads".
 *
 * @property int $upload_id
 * @property string|null $ref
 * @property string|null $file_name ชื่อไฟล์
 * @property string|null $real_filename ชื่อไฟล์จริง
 * @property string|null $create_date
 * @property int|null $type ประเภท
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['type'], 'integer'],
            [['ref'], 'string', 'max' => 50],
            [['file_name', 'real_filename'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => 'Upload ID',
            'ref' => 'Ref',
            'file_name' => 'ชื่อไฟล์',
            'real_filename' => 'ชื่อไฟล์จริง',
            'create_date' => 'Create Date',
            'type' => 'ประเภท',
        ];
    }


    public function Show(){
        $file_path = SystemHelper::getUploadPath() .$this->ref.'/'.$this->real_filename;
        // return 'hello';
        $width = 1080;
        $height = 1080;
        $files = SystemHelper::getImage($file_path, $width, $height);
       
        // return Html::img('/soc/events/image?file_path='.$file_path,['loading'=>'lazy','class' =>'card-image-top','alt' =>'thumbnail']);

    }

    public function viewFile(){

        $type = explode('.', $this->file_name);
        $file_path = SystemHelper::getUploadPath() . $this->ref . '/' . $this->real_filename;
        $file_ = pathinfo($file_path);
        if (file_exists($file_path)) {
            if($file_['extension'] == 'mp4' || $file_['extension'] == 'mov'){
                $file_path = "/soc/events/video?id=$this->upload_id&width=500&height=500";
                return  \wbraganca\videojs\VideoJsWidget::widget([
                    'options' => [
                        'class' => 'video-js vjs-default-skin vjs-big-play-centered',
                        'poster' => "http://www.videojs.com/img/poster.jpg",
                        'controls' => true,
                        'preload' => 'auto',
                        'width' => '970',
                        'height' => '400',
                    ],
                    'tags' => [
                        'source' => [
                            ['src' => $file_path, 'type' => 'video/mp4'],
                            ['src' => $file_path, 'type' => 'video/webm']
                        ],
                        'track' => [
                            ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English']
                        ]
                    ]
                ]);
            }else{
                // return 'xx';
                $file_path = "/soc/events/image?file_path=$file_path&width=500&height=500";
                return Html::img($file_path, ['class' => 'file-preview-image', 'loading' => 'lazy']);
            }
        }
    }

    public function getEvent() {
        return $this->hasOne(Events::className(), ['ref' => 'ref']);
    }
}
