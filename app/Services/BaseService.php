<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Services;

use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Hyperf\Contract\TranslatorInterface;

class BaseService
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

     /**
     * @Inject
     * @var TranslatorInterface
     */
    protected $translator;
}
