<?php

namespace Controller;

class Export
{
    private $response;

    public function __construct(
        \Parable\Http\Response $response
    ) {
        $this->response = $response;
    }

    public function index()
    {
    }

    public function latestMutation()
    {
        $repository = \Parable\ORM\Repository::createForModelName(\Model\PlayerTallyMutation::class);

        /** @var \Model\PlayerTallyMutation $latestMutation */
        $latestMutation = $repository->returnOne()
                                     ->orderBy("id", \Parable\ORM\Query::ORDER_DESC)
                                     ->limitOffset(1)
                                     ->getAll();

        $playerTally = $latestMutation->getPlayerTally();

        $data = [
            "mutation"     => $latestMutation->toArray(),
            "player_tally" => $playerTally->toArray(),
            "player"       => $playerTally->getPlayer()->toArray(),
            "tally"        => $playerTally->getTally()->toArray(),
        ];

        $this->response->enableHeaderAndFooterContent(false);
        $this->response->setOutput(new \Parable\Http\Output\Json());
        $this->response->setContent(json_encode($data, JSON_PRETTY_PRINT));
    }
}
