<?php

namespace Model;

class PlayerTallyMutation extends \Parable\ORM\Model
{
    /** @var string */
    protected $tableName = 'player_tally_mutation';
    /** @var string */
    protected $tableKey  = 'id';

    /** @var int */
    public $player_tally_id;
    /** @var int */
    public $amount;
    /** string */
    public $created_at;

    public function getPlayerTally()
    {
        return \Parable\ORM\Repository::createForModelName(\Model\PlayerTally::class)->getById($this->player_tally_id);
    }
}
