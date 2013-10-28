<?php

function wpLwfParse($content)
{
    return preg_replace_callback('#\[lwf\](.+\.js)\[/lwf\]#i', 'wpLwfRenderer', $content);
}

function wpLwfRenderer($lwf)
{
    $lwf_url = WP_PLUGIN_URL . '/wp-lwf/lwf-loader/js/lwf.js';
    $lwf_loader_url = WP_PLUGIN_URL . '/wp-lwf/lwf-loader/js/lwf-loader-all.min.js';

    $id = preg_replace('#http.+/|\.js#', '', $lwf[1]);

    $lwf_write
        = <<<EOT
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.2.1/lodash.min.js"></script>
    <script type="text/javascript" src="$lwf_url"></script>
    <script type="text/javascript" src="$lwf_loader_url"></script>
    <script type="text/javascript" src="$lwf[1]"></script>
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', function () {
            var tLwfLoader = new window['LwfLoader']();
            tLwfLoader['playLWF'](document.querySelector('#$id'), window['$id']);
        });
    </script>
    <div id="$id"></div>
EOT;

    return $lwf_write;
}