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

namespace Kaudaj\Module\DBVCS\Domain\Change\Command;

use Kaudaj\Module\DBVCS\Domain\Commit\ValueObject\CommitId;
use Kaudaj\Module\DBVCS\Domain\ValueObject\LocalizedDescription;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;

/**
 * Class AddChangeCommand is responsible for adding change data.
 */
class AddChangeCommand
{
    /**
     * @var ShopConstraint
     */
    private $shopConstraint;

    /**
     * @var CommitId|null
     */
    private $commitId;

    /**
     * @var array<int, LocalizedDescription>
     */
    private $localizedDescriptions = [];

    public function __construct(ShopConstraint $shopConstraint)
    {
        $this->shopConstraint = $shopConstraint;
    }

    public function getShopConstraint(): ShopConstraint
    {
        return $this->shopConstraint;
    }

    public function getCommitId(): ?CommitId
    {
        return $this->commitId;
    }

    public function setCommitId(?int $commitId): self
    {
        if ($commitId !== null) {
            $commitId = new CommitId($commitId);
        }

        $this->commitId = $commitId;

        return $this;
    }

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
