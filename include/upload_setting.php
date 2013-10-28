<?php
/**
 * LWF file upload hook function.
 * add ext type .lwf, and add mine_type application/octet-stream
 */

function addLwfType($ext2type)
{
    array_push($ext2type, array('interactive' => 'lwf'));

    return $ext2type;
}

function addLwfMimeType($mine_types)
{
    $mine_types['lwf'] = 'application/octet-stream';

    return $mine_types;
}
