<?php

namespace devtoolboxuk\seshat\Model;

use devtoolboxuk\utilitybundle\UtilityService;

class SeshatModel
{

    /**
     * @var integer
     */
    private $ip_address;

    /**
     * @var string
     */
    private $blockType;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \DateTime|null
     */
    private $updated_at;

    /**
     * @var int
     */
    private $ban_period;

    /**
     * @var null
     */
    private $removeBan = null;

    /**
     * @var UtilityService
     */
    private $utilityService;

    /**
     * TartarusModel constructor.
     * @param int $ip_address
     * @param string $blockType
     * @param string $comment
     * @param null $updated_at
     * @param int $ban_period
     */
    function __construct($ip_address = 0, $blockType = '', $comment = '', $updated_at = null, $ban_period = 0)
    {
        $this->ip_address = $ip_address;
        $this->blockType = $blockType;
        $this->comment = $comment;
        $this->updated_at = $updated_at;
        $this->ban_period = $ban_period;
        $this->utilityService = new UtilityService();
    }

    /**
     * @param $ip_address
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'ip_address' => $this->getIpAddress(),
            'block_type' => $this->getBlockType(),
            'blocked' => $this->isBlocked(),
            'comment' => $this->getComment(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }

    /**
     * Confirms if the Ban expired. Only used for temporary bans
     *
     * @return bool|null
     */
    private function checkIfBanExpired()
    {
        $banDate = $this->utilityService->date()->modify(sprintf('-%d seconds', $this->ban_period));

        if ($this->utilityService->date()->datePassed($this->getUpdatedAt(), $banDate)) {
            return true;
        }
        return null;
    }

    /**
     * @return null
     */
    public function removeBan()
    {
        return $this->removeBan;
    }

    /**
     * @return bool|null
     */
    public function isBlocked()
    {
        switch ($this->getBlockType()) {

            case 'T'://Temporary Ban
                if (!$this->checkIfBanExpired()) {
                    return true;
                }
                $this->removeBan = true;
                break;

            case 'B'://Permanend Ban
                return true;
                break;;
        }
        return null;
    }

    /**
     * @return int
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * @param $blockType
     */
    public function setBlockType($blockType)
    {
        $this->blockType = $blockType;
    }

    /**
     * @return string
     */
    public function getBlockType()
    {
        return $this->blockType;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
