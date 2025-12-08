<?php
namespace App\Services;
class AlertService
{
    public static function updated($message=null)
    {
                notyf()->success($message ? $message :'updated successfully!');

    }
    public static function created($message=null)
    {
                notyf()->success($message ? $message :'created successfully!');

    }
}