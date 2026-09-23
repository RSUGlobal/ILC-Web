<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CoursePdf
{
    public const RULES = ['file', 'mimes:pdf', 'extensions:pdf', 'max:10240'];

    public static function store(UploadedFile $file): string
    {
        $path = $file->store('course-materials', 'local');

        if (! $path) {
            throw ValidationException::withMessages(['pdf' => 'The PDF could not be saved. Please try again.']);
        }

        return $path;
    }

    public static function respond(?string $storedPath, string $title, bool $download): BinaryFileResponse
    {
        $path = $storedPath ? Storage::disk('local')->path($storedPath) : null;
        abort_unless($path && is_file($path), 404, 'This PDF is unavailable.');

        $response = response()->file($path, [
            'Content-Type' => 'application/pdf',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'no-cache, private',
        ]);
        $response->setContentDisposition(
            $download ? ResponseHeaderBag::DISPOSITION_ATTACHMENT : ResponseHeaderBag::DISPOSITION_INLINE,
            (Str::slug($title) ?: 'course-document').'.pdf',
        );

        return $response;
    }
}
