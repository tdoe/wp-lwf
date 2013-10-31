<?php

function wpLwfParse($content)
{
    return preg_replace_callback('#\[lwf\](.+\.js)\[/lwf\]#i', 'wpLwfRenderer', $content);
}

function wpLwfRenderer($lwf)
{
    $id = preg_replace('#http.+/|\.js#', '', $lwf[1]);

    $lwf_write
        = <<<EOT
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