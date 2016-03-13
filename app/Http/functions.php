<?php

namespace Rush\Http;

use \Psr\Http\Message\ResponseInterface;

// TODO: https://github.com/slimphp/Slim/blob/3.x/Slim/App.php#L354
function respond(ResponseInterface $res)
{
    // Send response
    if (!headers_sent()) {
        // Status
        header(sprintf(
            'HTTP/%s %s %s',
            $res->getProtocolVersion(),
            $res->getStatusCode(),
            $res->getReasonPhrase()
        ));
        // Headers
        foreach ($res->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }
    }
    // Body
    if (!isEmptyResponse($res)) {
        $body = $res->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }
        $contentLength  = $res->getHeaderLine('Content-Length');
        $chunkSize      = 4096;
        if (!$contentLength) {
            $contentLength = $body->getSize();
        }
        if (isset($contentLength)) {
            $totalChunks    = ceil($contentLength / $chunkSize);
            $lastChunkSize  = $contentLength % $chunkSize;
            $currentChunk   = 0;
            while (!$body->eof() && $currentChunk < $totalChunks) {
                if (++$currentChunk == $totalChunks && $lastChunkSize > 0) {
                    $chunkSize = $lastChunkSize;
                }
                echo $body->read($chunkSize);
                if (connection_status() != CONNECTION_NORMAL) {
                    break;
                }
            }
        } else {
            while (!$body->eof()) {
                echo $body->read($chunkSize);
                if (connection_status() != CONNECTION_NORMAL) {
                    break;
                }
            }
        }
    }
}

function isEmptyResponse(ResponseInterface $res)
{
    if (method_exists($res, 'isEmpty')) {
        return $res->isEmpty();
    }
    return in_array($res->getStatusCode(), [204, 205, 304]);
}
