<?php
require_once ('db.php');
/*
 # -- BEGIN LICENSE BLOCK ----------------------------------
 #
 # This file is part of MAGIX CMS.
 # MAGIX CMS, The content management system optimized for users
 # Copyright (C) 2008 - 2013 magix-cms.com <support@magix-cms.com>
 #
 # OFFICIAL TEAM :
 #
 #   * Gerits Aurelien (Author - Developer) <aurelien@magix-cms.com> <contact@aurelien-gerits.be>
 #
 # Redistributions of files must retain the above copyright notice.
 # This program is free software: you can redistribute it and/or modify
 # it under the terms of the GNU General Public License as published by
 # the Free Software Foundation, either version 3 of the License, or
 # (at your option) any later version.
 #
 # This program is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY; without even the implied warranty of
 # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 # GNU General Public License for more details.
 #
 # You should have received a copy of the GNU General Public License
 # along with this program.  If not, see <http://www.gnu.org/licenses/>.
 #
 # -- END LICENSE BLOCK -----------------------------------
 #
 # DISCLAIMER
 #
 # Do not edit or add to this file if you wish to upgrade MAGIX CMS to newer
 # versions in the future. If you wish to customize MAGIX CMS for your
 # needs please refer to http://www.magix-cms.com for more information.
 */
require_once 'geoip2/vendor/autoload.php';
use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

class plugins_geoip2_public extends plugins_geoip2_db
{
    protected $template, $data, $httpSession, $setting;

    /**
     * frontend_controller_home constructor.
     */
    public function __construct($t = null)
    {
        $this->template = $t instanceof frontend_model_template ? $t : new frontend_model_template();
        $this->data = new frontend_model_data($this, $this->template);
        $this->setting = new frontend_model_setting($t);
        $ssl = $this->setting->getSetting('ssl');
        $this->httpSession = new http_session($ssl['value']);
    }

    /**
     * Assign data to the defined variable or return the data
     * @param string $type
     * @param string|int|null $id
     * @param string $context
     * @param boolean $assign
     * @return mixed
     */
    private function getItems($type, $id = null, $context = null, $assign = true)
    {
        return $this->data->getItems($type, $id, $context, $assign);
    }
    /**
     * @return mixed
     */
    public function setItemData(){
        $setData = $this->getItems('root',NULL,'one',false);
        return $setData;
    }

    /**
     * @return string|null
     */
    public function getIsoCountry(){
        $logger = new debug_logger(MP_LOG_DIR);
        try {
            $api = $this->setItemData();
            $mode = $this->setting->getSetting('mode');
            if($mode != 'prod'){
                $ipUser = !in_array($this->httpSession->getIp(), array($api['ip_gip'], '::1')) ? $this->httpSession->getIp()  : $api['ip_gip'];
            }else{
                $ipUser = $this->httpSession->getIp();
            }

            if ($api != null AND $ipUser != null) {
                if (filter_var($ipUser, FILTER_VALIDATE_IP)) {
                    if($api['ws_gip']!='0') {
                        $client = new Client(
                            $api['user_gip'],
                            $api['key_gip'],
                            ['en'],
                            ['host' => 'geolite.info']
                        );
                        $record = $client->country($ipUser);
                    }else{
                        if(file_exists(component_core_system::basePath() .'plugins/geoip2/GeoLite2-Country.mmdb')) {
                            $reader = new Reader(
                                component_core_system::basePath() . 'plugins/geoip2/GeoLite2-Country.mmdb'
                            );
                            $record = $reader->country($ipUser);
                        }else{
                            return;
                        }
                    }
                    return $record->country->isoCode;
                }
            }
        }catch (Exception $e){
            //$logger = new debug_logger(MP_LOG_DIR);
            $logger->log('php', 'error', 'An error has occured : ' . $e->getMessage(), debug_logger::LOG_MONTH);
        }
    }
    /*public function run(){
        //print_r($this->getIsoCountry());
        $api = $this->setItemData();
        $reader = new Reader(component_core_system::basePath() .'plugins/geoip2/GeoLite2-Country.mmdb');
        $record = $reader->country($api['ip_gip']);
        print($record->country->isoCode . "\n");
        //print $reader->country($api['ip_gip']);
    }*/
}
?>