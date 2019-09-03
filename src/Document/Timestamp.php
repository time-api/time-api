<?php
/*
 * This file is part of the Time API project.
 *
 * (c) Timicx GmbH <contact@timicx.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Document;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
/**
 * Class Timestamp
 *
 * @ApiResource
 * @ODM\Document
 */
class Timestamp
{
    /**
     * @ODM\Id(strategy="UUID")
     */
    public $id;
}
