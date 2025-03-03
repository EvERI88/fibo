<?php

/* This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */
namespace Phalcon\Support\Helper\Str;

/**
 * Converts strings to PascalCase style
 */
class PascalCase
{
    /**
     * @param string      $text
     * @param string|null $delimiters
     *
     * @return string
     */
    public function __invoke(string $text, string $delimiters = null): string
    {
    }

    /**
     * @param string      $text
     * @param string|null $delimiters
     *
     * @return array
     */
    protected function processArray(string $text, string $delimiters = null): array
    {
    }
}
