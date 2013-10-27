<?php

function wpLwfSettingParse($content) {
    return preg_replace_callback('#\[lwf_setting\](.+\.js)\[/lwf_setting\]#i', 'wpLwfSetting', $content);
}

function wpLwfSetting($content) {
    return '<script type="text/javascript" src="' . $content[1] . '"></script>';
}