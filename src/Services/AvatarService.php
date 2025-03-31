<?php

namespace App\Services;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;

class AvatarService
{
    public function __construct(
        private string $assetsDir,
        private string $avatarsDir,
    ) {
    }

    public function getAllAvatarsImages(): array
    {
        $images = [];
        $finder = new Finder();

        foreach ($finder->files()->in($this->avatarsDir)->name('*.png') as $file) {
            $images[] = Path::makeRelative($file->getPathname(), $this->assetsDir);
        }

        return $images;
    }

    /**
     * @throws \Exception
     */
    public function exists(string $path): bool
    {
        $filesystem = new Filesystem();

        $path = $this->makeAbsolute($path);

        return $filesystem->exists($path);
    }

    /**
     * @throws \Exception
     */
    public function makeAbsolute(string $path): string
    {
        return Path::makeAbsolute($path, $this->assetsDir);
    }
}
