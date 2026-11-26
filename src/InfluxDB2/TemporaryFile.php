<?php

namespace InfluxDB2;

/**
 * File downloaded from InfluxDB into the temp folder.
 *
 * The file is deleted when the object is destroyed, copy it to keep it:
 *
 * <code>
 * copy($file->getRealPath(), '/path/to/backup');
 * </code>
 */
class TemporaryFile extends \SplFileObject
{
    public function __destruct()
    {
        $path = $this->getRealPath();
        if ($path !== false && is_file($path)) {
            @unlink($path);
        }
    }
}
