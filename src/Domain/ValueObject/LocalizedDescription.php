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

namespace Kaudaj\Module\DBVCS\Domain\ValueObject;

use Kaudaj\Module\DBVCS\ConstraintValidator\Factory\CleanHtmlValidatorFactory;
use Kaudaj\Module\DBVCS\Domain\Change\Exception\ChangeException;
use PrestaShop\PrestaShop\Adapter\Configuration;
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\CleanHtml;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class LocalizedDescription
 */
class LocalizedDescription
{
    /**
     * @var string
     */
    private $description;

    /**
     * @throws ChangeException
     */
    public function __construct(string $description)
    {
        $this->assertIsValid($description);

        $this->description = $description;
    }

    /**
     * @throws ChangeException
     */
    private function assertIsValid(string $description): void
    {
        $violations = $this->getValidator()->validate($description, [
            new NotBlank(),
            new CleanHtml(),
        ]);

        if (0 !== count($violations)) {
            throw new ChangeException(sprintf('Invalid Change description: %s', $violations->get(0)->getMessage()));
        }
    }

    public function getValidator(): ValidatorInterface
    {
        $configuration = new Configuration();
        $allowEmbeddableHtml = $configuration->getBoolean('PS_ALLOW_HTML_IFRAME');

        $validatorBuilder = Validation::createValidatorBuilder();
        $validatorBuilder->setConstraintValidatorFactory(
            new CleanHtmlValidatorFactory($allowEmbeddableHtml)
        );

        return $validatorBuilder->getValidator();
    }

    public function getValue(): string
    {
        return $this->description;
    }
}
