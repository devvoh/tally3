<?php

namespace Model;

class Player extends \Parable\ORM\Model
{
    /** @var \Parable\Framework\Toolkit */
    protected $toolkit;

    /** @var string */
    protected $tableName = 'player';
    /** @var string */
    protected $tableKey  = 'id';

    /** @var string */
    public $name;

    public function __construct(
        \Parable\ORM\Database $database,
        \Parable\Framework\Toolkit $toolkit
    ) {
        $this->toolkit = $toolkit;
        parent::__construct($database);
    }

    /**
     * @return \Model\Tally[]|\Parable\ORM\Model[]
     */
    public function getTallies()
    {
        $playerTallyRepo = $this->toolkit->getRepository(\Model\PlayerTally::class);
        $playerTallies = $playerTallyRepo->getByCondition("player_id", "=", $this->id);

        $tallyIds = [];
        /** @var \Model\PlayerTally $playerTally */
        foreach ($playerTallies as $playerTally) {
            $tallyIds[] = $playerTally->tally_id;
        }

        $tallyRepo = $this->toolkit->getRepository(\Model\Tally::class);
        return $tallyRepo->getByCondition("id", "in", $tallyIds);
    }
}
