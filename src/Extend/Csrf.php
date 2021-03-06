<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Extend;

use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class Csrf implements ExtenderInterface
{
    protected $csrfExemptPaths = [];

    public function exemptPath(string $path)
    {
        $this->csrfExemptPaths[] = $path;

        return $this;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        $container->extend('flarum.http.csrfExemptPaths', function ($existingExemptPaths) {
            return array_merge($existingExemptPaths, $this->csrfExemptPaths);
        });
    }
}
