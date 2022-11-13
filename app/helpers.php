<?php
function getSetting()
{
    $setting = DB::table('setting')
    ->where('id', 1)
    ->first();

    return $setting;
}