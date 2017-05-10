<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $setting = $this->findSetting('title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '网站标题',
                'value'        => '在这里设置你的网站标题',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
            ])->save();
        }

        $setting = $this->findSetting('description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '网站描述',
                'value'        => '在这里设置你的网站描述',
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
            ])->save();
        }

        $setting = $this->findSetting('logo');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '网站 Logo',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 3,
            ])->save();
        }

        $setting = $this->findSetting('admin_bg_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '后台侧边背景图',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 9,
            ])->save();
        }

        $setting = $this->findSetting('admin_title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '后台标题',
                'value'        => 'Voyager',
                'details'      => '',
                'type'         => 'text',
                'order'        => 4,
            ])->save();
        }

        $setting = $this->findSetting('admin_description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '后台描述',
                'value'        => '欢迎使用基于 Laravel 的后台扩展 Voyager.',
                'details'      => '',
                'type'         => 'text',
                'order'        => 5,
            ])->save();
        }

        $setting = $this->findSetting('admin_loader');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '后台加载图片',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 6,
            ])->save();
        }

        $setting = $this->findSetting('admin_icon_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '后台 Icon 图',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 7,
            ])->save();
        }

        $setting = $this->findSetting('google_analytics_client_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '谷歌分析客户端 ID',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 9,
            ])->save();
        }
    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
