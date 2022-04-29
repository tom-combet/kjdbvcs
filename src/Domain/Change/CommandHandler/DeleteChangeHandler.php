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

namespace Kaudaj\Module\DBVCS\Domain\Change\CommandHandler;

use Exception;
use Kaudaj\Module\DBVCS\Domain\Change\Command\DeleteChangeCommand;
use Kaudaj\Module\DBVCS\Domain\Change\Exception\CannotDeleteChangeException;
use Kaudaj\Module\DBVCS\Domain\Change\Exception\ChangeException;

/**
 * Class DeleteChangeHandler is responsible for deleting change data.
 *
 * @internal
 */
final class DeleteChangeHandler extends AbstractChangeCommandHandler
{
    /**
     * @throws ChangeException
     */
    public function handle(DeleteChangeCommand $command): void
    {
        $entity = $this->getChangeEntity(
            $command->getChangeId()->getValue()
        );

        // TODO: Delete attached file too in version-control/changes folder

        try {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            throw new CannotDeleteChangeException('An unexpected error occurred when deleting change', 0, $exception);
        }
    }
}
