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

namespace Kaudaj\Module\DBVCS\Domain\Commit\Command;

use Kaudaj\Module\DBVCS\Domain\ValueObject\LocalizedDescription;

/**
 * Class AddCommitCommand is responsible for adding commit data.
 */
class AddCommitCommand
{
    /**
     * @var array<int, LocalizedDescription>
     */
    private $localizedDescriptions = [];

    /**
     * @return array<int, LocalizedDescription>
     */
    public function getLocalizedDescriptions(): array
    {
        return $this->localizedDescriptions;
    }

    /**
     * @param array<int, string> $localizedDescriptions
     */
    public function setLocalizedDescriptions(array $localizedDescriptions): self
    {
        foreach ($localizedDescriptions as $langId => $description) {
            $this->localizedDescriptions[$langId] = new LocalizedDescription($description);
        }

        return $this;
    }
}
