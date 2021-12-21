<?php

function gesture_asset($path, $secure = null)
{
    return asset('assets/' . $path, $secure);
}
