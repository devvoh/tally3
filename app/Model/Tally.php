<?php

namespace Model;

class Tally extends \Parable\ORM\Model
{
    /** @var \Parable\Framework\Toolkit */
    protected $toolkit;

    /** @var string */
    protected $tableName = 'tally';
    /** @var string */
    protected $tableKey  = 'id';

    /** @var string */
    public $name;

    /** @var \Model\PlayerTallyMutation[] */
    public $mutations;

    /** @var \Model\PlayerTally */
    public $playerTally;

    public function __construct(
        \Parable\ORM\Database $database,
        \Parable\Framework\Toolkit $toolkit
    ) {
        $this->toolkit = $toolkit;
        parent::__construct($database);
    }

    public function getCurrentAmountForPlayer(\Model\Player $player)
    {
        $amount = 0;
        foreach ($this->getMutationsForPlayer($player) as $mutation) {
            $amount += $mutation->amount;
        }
        return $amount;
    }

    public function getPlayerTallyForPlayer($player)
    {
        $this->getMutationsForPlayer($player);

        return $this->playerTally;
    }

    public function getMutationsForPlayer(\Model\Player $player)
    {
        if (!$this->mutations) {
            $playerTallyRepo = $this->toolkit->getRepository(\Model\PlayerTally::class);
            $playerTally = $playerTallyRepo->returnOne()->getByConditionSet(
                $playerTallyRepo->createQuery()->buildAndSet([
                    ["tally_id", "=", $this->id],
                    ["player_id", "=", $player->id],
                ])
            );

            $this->playerTally = $playerTally;

            $playerTallyMutationRepo = $this->toolkit->getRepository(\Model\PlayerTallyMutation::class);

            $this->mutations = $playerTallyMutationRepo->getByCondition("player_tally_id", "=", $playerTally->id);
        }
        return $this->mutations;
    }
}
