<?php

function wpLwfParse($content) {
    return preg_replace_callback('#\[lwf\](.+\.lwf)\[/lwf\]#i', 'wpLwfRenderer', $content);
}

function wpLwfRenderer($lwf) {

    $lwf_url        = WP_PLUGIN_URL . '/wp-lwf/lwf-loader/js/lwf.js';
    $lwf_loader_url = WP_PLUGIN_URL . '/wp-lwf/lwf-loader/js/lwf-loader-all.min.js';

    $lwf_write
        = <<<EOT
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.2.1/lodash.min.js"></script>
    <script type="text/javascript" src="$lwf_url"></script>
    <script type="text/javascript" src="$lwf_loader_url"></script>
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', function () {
            var tElements = document.querySelectorAll('.lwf');

            var paramCallback = function (pElement) {
                return {
                    callback: {
                        onLoad: function (pLwf) {
                            console.log(pLwf);
                        }
                    }
                }
            };

            var paramHandler = function (pElement) {
                return {
                    handler: {
                        loadError: function (e) {
                            console.log(e);
                        },

                        exception: function (e) {
                            console.log(e);
                        }
                    }
                }
            };

            var setting = {
                pos: {
                    position: 'relative'
                }
            };

            for (var i = 0; i < tElements.length; i++) {
                tElements[i].setAttribute("data-lwf-pos", JSON.stringify(setting.pos));
                tElements[i].setAttribute("data-lwf-name", '$lwf[1]');

                if(window['settings'] != undefined) {
                    if(window['settings']['imageMap'] != undefined) {
                        tElements[i].setAttribute("data-lwf-image_map", JSON.stringify(window['settings']['imageMap']));
                    }

                    if(window['settings']['privateData'] != undefined) {
                        tElements[i].setAttribute("data-lwf-private_data", JSON.stringify(window['settings']['privateData']));
                    }
                }

                var tLwfLoader = new window['LwfLoader']();
                tLwfLoader.addInitializeHook(paramHandler);
                tLwfLoader.addInitializeHook(paramCallback);
                tLwfLoader['playLWF'](tElements[i]);
            }
        });
    </script>
    <div class="lwf"></div>
EOT;

    return $lwf_write;
}