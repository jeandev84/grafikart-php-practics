<?php
declare(strict_types=1);

namespace Tests\Framework\Session;


use Framework\Session\ArraySession;
use Framework\Session\FlashService;
use PHPUnit\Framework\TestCase;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @FlashServiceTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Session
 */
class FlashServiceTest extends TestCase
{


        /**
         * @var ArraySession
        */
        protected ArraySession $session;


        /**
          * @var FlashService
        */
        protected FlashService $flashService;


        public function setUp(): void
        {
            $this->session = new ArraySession();
            $this->flashService = new FlashService($this->session);
        }




        public function testDeleteFlashAfterGettingIt()
        {
            $this->flashService->success('Bravo');
            $this->assertEquals('Bravo', $this->flashService->get('success'));
            $this->assertNull($this->session->get('flash'));
            $this->assertEquals('Bravo', $this->flashService->get('success'));
            $this->assertEquals('Bravo', $this->flashService->get('success'));
        }
}