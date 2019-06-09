<?php

namespace devtoolboxuk\seshat;


final class SeshatService
{
    /**
     * @var SeshatRepository
     */
    private $seshatRepository;

    private $seshatLog;

    public function __construct(SeshatRepository $seshatRepository = null)
    {
        $this->seshatRepository = $seshatRepository;
        $this->seshatLog = new SeshatLog();
    }

}
