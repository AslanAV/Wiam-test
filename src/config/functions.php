<?php

/**
 * Debug function
 * d($var);
 */
function d($var,$caller=null)
{
    echo '<code>File: '.' / Line: '.'</code>';
    echo '<pre>';
    yii\helpers\VarDumper::dump($var, 10, true);
    echo '</pre>';
}

/**
 * Debug function with die() after
 * dd($var);
 */
function dd($var)
{

    d($var);
    die();
}
