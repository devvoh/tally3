<?php

namespace Model;

class PlayerTally extends \Parable\ORM\Model
{
    /** @var string */
    protected $tableName = 'player_tally';
    /** @var string */
    protected $tableKey  = 'id';

    /** @var int */
    public $player_id;
    /** @var int */
    public $tally_id;

    /**
     * @return null|\Parable\ORM\Model|\Model\Player
     * @throws \Parable\ORM\Exception
     */
    public function getPlayer()
    {
        return \Parable\ORM\Repository::createForModelName(\Model\Player::class)->getById($this->player_id);
    }

    /**
     * @return null|\Parable\ORM\Model|\Model\Tally
     * @throws \Parable\ORM\Exception
     */
    public function getTally()
    {
        return \Parable\ORM\Repository::createForModelName(\Model\Tally::class)->getById($this->tally_id);
    }
}
