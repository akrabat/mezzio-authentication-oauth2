<?php

/**
 * @see       https://github.com/mezzio/mezzio-authentication-oauth2 for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-authentication-oauth2/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-authentication-oauth2/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace MezzioTest\Authentication\OAuth2\Repository\Pdo;

use Mezzio\Authentication\OAuth2\Repository\Pdo\ClientRepository;
use Mezzio\Authentication\OAuth2\Repository\Pdo\ClientRepositoryFactory;
use Mezzio\Authentication\OAuth2\Repository\Pdo\PdoService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ClientRepositoryFactoryTest extends TestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->pdo = $this->prophesize(PdoService::class);
    }

    public function testFactory()
    {
        $this->container
            ->get(PdoService::class)
            ->willReturn($this->pdo->reveal());

        $factory = (new ClientRepositoryFactory)($this->container->reveal());
        $this->assertInstanceOf(ClientRepository::class, $factory);
    }
}