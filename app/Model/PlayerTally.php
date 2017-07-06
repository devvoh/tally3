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
}
