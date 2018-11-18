<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 29/10/2018
 * Time: 16:31
 */

namespace Flexe\Http\Factory;

use Slim\Http\UploadedFile as SlimUploadedFile;

use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\StreamInterface;

class UploadedFileFactory implements UploadedFileFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createUploadedFile(
        StreamInterface $stream,
        ?int $size = null,
        int $error = \UPLOAD_ERR_OK,
        ?string $clientFilename = null,
        ?string $clientMediaType = null
    ): UploadedFileInterface {
        if ($size === null) {
            $size = $stream->getSize();
        }


        if (class_exists(SlimUploadedFile::class)) {
            $meta = $stream->getMetadata();
            $file = $meta["uri"];

            if ($file === "php://temp") {
                $file = tempnam(sys_get_temp_dir(), "factory-test");
                file_put_contents($file, (string) $stream);
            }

            return new SlimUploadedFile(
                $file,
                $clientFilename,
                $clientMediaType,
                $size,
                $error
            );
        }

        throw new \RuntimeException("No PSR-7 implementation available");
    }

}