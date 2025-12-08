<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
public function uploadFile(UploadedFile $file = null, ?string $oldPath = null, ?string $path = 'uploads'): ?string
{
    $defaultAvatar = '/default/avatar.png';
    $ignorePath = [$defaultAvatar];

    // اگر فایل جدید ارسال نشده → آواتار پیش‌فرض را برگردان
    if (!$file) {
        return $defaultAvatar;
    }

    // اگر فایل مشکل دارد → آواتار پیش‌فرض
    if (!$file->isValid()) {
        return $defaultAvatar;
    }

    // حذف فایل قبلی به شرطی که پیش‌فرض نباشد
    if ($oldPath && File::exists(public_path($oldPath)) && !in_array($oldPath, $ignorePath)) {
        File::delete(public_path($oldPath));
    }

    // مسیر پوشه
    $folderPath = public_path($path);

    // ساخت نام جدید
    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

    // انتقال فایل
    $file->move($folderPath, $filename);

    // مسیر نهایی
    return $path . '/' . $filename;
}
}