<?php

namespace app\components;

use yii\base\Component;

class LineHelper extends Component
{

    public static function siteConfig()
    {
        return SiteHelper::info();
    }

    public static function setRegisterMenu($lineId)
    {
        try {
            
            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = $site['line_token'];
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['richmenu_register']}";
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $strUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Throwable$th) {
            //throw $th;
            return false;
        }
    }

    public static function setMainMenu($lineId)
    {
        try {

            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = $site['line_token'];
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['richmenu_mainmenu']}";
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $strUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Throwable$th) {
            //throw $th;
            return false;
        }
    }


    public static function setRegisterMenuSocGuard($lineId)
    {
        try {
            
            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = $site['guard_line_token'];
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['guard_richmenu_register']}";
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $strUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Throwable$th) {
            //throw $th;
            return false;
        }
    }

    public static function setMainMenuSocGuard($lineId)
    {
        try {

            $site = self::siteConfig();
            $ch = curl_init();

            $strAccessToken = $site['guard_line_token'];
            // $lineId = $model->line_id;
            $strUrl = "https://api.line.me/v2/bot/user/{$lineId}/richmenu/{$site['guard_richmenu_mainmenu']}";
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $strUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Throwable$th) {
            //throw $th;
            return false;
        }
    }

}
