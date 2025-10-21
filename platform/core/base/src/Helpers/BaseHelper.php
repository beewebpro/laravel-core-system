<?php

namespace Bng\Base\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Throwable;

class BaseHelper
{
  public function getAdminPrefix(): string
  {
    $prefix = config('core.base.general.admin_dir');
    if (! $prefix) {
      return 'admin';
    }
    return $prefix;
  }

  public function clean(array|string|null $dirty, array|string $config = null): array|string|null
  {
    if (config('core.base.general.enable_less_secure_web', false)) {
      return $dirty;
    }

    if (! $dirty && $dirty !== null) {
      return $dirty;
    }

    if (! is_numeric($dirty)) {
      $dirty = (string) $dirty;
    }

    return clean($dirty, $config);
  }

  public function formatDate(CarbonInterface|int|string|null $date, ?string $format = null, bool $translated = false): ?string
  {
    if (empty($format)) {
      $format = $this->getDateFormat();
    }

    if (empty($date)) {
      return $date;
    }

    if (! $date instanceof CarbonInterface) {
      $date = Carbon::parse($date);
    }

    return $this->formatTime($date, $format, $translated);
  }

  public function formatTime(CarbonInterface $timestamp, ?string $format = 'j M Y H:i', bool $translated = false): string
  {
    $first = Carbon::create(0000, 0, 0, 00, 00, 00);

    if ($timestamp->lte($first)) {
      return '';
    }

    if ($translated) {
      return $timestamp->translatedFormat($format);
    }

    return $timestamp->format($format);
  }

  public function getDateFormats(): array
  {
    $formats = [
      'Y-m-d',
      'Y-M-d',
      'y-m-d',
      'm-d-Y',
      'M-d-Y',
    ];

    foreach ($formats as $format) {
      $formats[] = str_replace('-', '/', $format);
    }

    $formats[] = 'M d, Y';

    return $formats;
  }

  public function getDateFormat(): string
  {
    return config('core.base.general.date_format.date');
  }

  public function cleanToastMessage(string $message): string
  {
    if (Str::startsWith($message, ['http://', 'https://'])) {
      return $message;
    }

    return addslashes($message);
  }

  public function logError(Throwable $throwable): void
  {
    logger()->error($throwable->getMessage() . ' - ' . $throwable->getFile() . ':' . $throwable->getLine());
  }

  public function saveFileData(string $path, array|string|null $data, bool $json = true): bool
  {
    try {
      if ($json) {
        $data = $this->jsonEncodePrettify($data);
      }

      File::ensureDirectoryExists(File::dirname($path));

      File::put($path, $data);

      return true;
    } catch (Throwable $throwable) {
      $this->logError($throwable);

      return false;
    }
  }

  public function jsonEncodePrettify(array|string|null $data): string
  {
    return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
  }
}
