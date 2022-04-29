<?php
/**
 * Copyright since 2019 Kaudaj
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@kaudaj.com so we can send you a copy immediately.
 *
 * @author    Kaudaj <info@kaudaj.com>
 * @copyright Since 2019 Kaudaj
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

namespace Kaudaj\Module\DBVCS\Search\Filters;

use Kaudaj\Module\DBVCS\Grid\Definition\Factory\CommitGridDefinitionFactory;
use PrestaShop\PrestaShop\Core\Search\Filters;

final class CommitFilters extends Filters
{
    /** @var string */
    protected $filterId = CommitGridDefinitionFactory::GRID_ID;

    /**
     * @return array<string, mixed>
     */
    public static function getDefaults(): array
    {
        return [
            'limit' => static::LIST_LIMIT,
            'offset' => 0,
            'orderBy' => 'date_add',
            'sortOrder' => 'DESC',
            'filters' => [],
        ];
    }
}