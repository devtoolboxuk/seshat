<?php

namespace devtoolboxuk\seshat;

use devtoolboxuk\seshat\Model\SeshatModel;

final class LoggingService
{
    /**
     * @var SeshatService
     */
    private $seshat;

    /**
     * @var SeshatRepository
     */
    private $seshatRepository;

    /**
     * LoggingService constructor.
     * @param SeshatRepository|null $seshatRepository
     */
    public function __construct(SeshatRepository $seshatRepository = null)
    {
        parent::__construct();
        $this->seshatRepository = $seshatRepository;
        $this->seshat = new SeshatService($this->seshatRepository);
    }

}
