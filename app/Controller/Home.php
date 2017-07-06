<?php

namespace Controller;

class Home
{
    /** @var \Parable\Framework\Toolkit */
    protected $toolkit;

    /** @var \Parable\GetSet\Internal */
    protected $internal;

    /** @var \Parable\Http\Request */
    protected $request;

    /** @var \Parable\GetSet\Post */
    protected $post;

    /** @var \Parable\GetSet\SessionMessage */
    protected $sessionMessage;

    public function __construct(
        \Parable\Framework\Toolkit $toolkit,
        \Parable\GetSet\Internal $internal,
        \Parable\Http\Request $request,
        \Parable\GetSet\Post $post,
        \Parable\GetSet\SessionMessage $sessionMessage
    ) {
        $this->toolkit = $toolkit;
        $this->internal = $internal;
        $this->request = $request;
        $this->post = $post;
        $this->sessionMessage = $sessionMessage;
    }

    /**
     * @param \Parable\Routing\Route $route
     */
    public function index(\Parable\Routing\Route $route)
    {
        $players = $this->toolkit->getRepository(\Model\Player::class);
        $this->internal->set("players", $players->getAll());
    }

    /**
     * @param \Parable\Routing\Route $route
     */
    public function player(\Parable\Routing\Route $route, $id)
    {
        $player = $this->toolkit->getRepository(\Model\Player::class)->getById($id);

        $this->internal->set("player", $player);
    }

    public function addTally(\Parable\Routing\Route $route)
    {
        if ($this->request->isPost()) {
            if (!$this->post->get("name")) {
                $this->sessionMessage->add("Name required.", "error");
                $this->toolkit->redirectToRoute("add-tally");
            }
            $tally = $this->toolkit->getRepository(\Model\Tally::class)->createModel();
            $tally->name = $this->post->get("name");
            $tally->save();

            $this->sessionMessage->add("Tally saved.", "success");
            $this->toolkit->redirectToRoute("index");
        }
    }

    public function addPlayer(\Parable\Routing\Route $route)
    {
        if ($this->request->isPost()) {
            if (!$this->post->get("name")) {
                $this->sessionMessage->add("Name required.", "error");
                $this->toolkit->redirectToRoute("add-player");
            }
            $player = $this->toolkit->getRepository(\Model\Player::class)->createModel();
            $player->name = $this->post->get("name");
            $player->save();

            $this->sessionMessage->add("Player saved.", "success");
            $this->toolkit->redirectToRoute("index");
        }
    }

    public function addPlayerTally(\Parable\Routing\Route $route, $id)
    {
        /** @var \Model\Player $player */
        $player  = $this->toolkit->getRepository(\Model\Player::class)->getById($id);
        $tallies = $this->toolkit->getRepository(\Model\Tally::class)->getAll();

        $playerTallies = $player->getTallies();

        $this->internal->setAll([
            "player" => $player,
            "playerTallies" => $playerTallies,
            "tallies" => $tallies,
        ]);
    }

    public function mutate(\Parable\Routing\Route $route, $playerTallyId, $amount)
    {
        /** @var \Model\PlayerTallyMutation $mutation */
        $mutation = $this->toolkit->getRepository(\Model\PlayerTallyMutation::class)->createModel();
        $mutation->player_tally_id = $playerTallyId;
        $mutation->amount = $amount;
        $mutation->save();
    }

    public function addTallyToPlayer(\Parable\Routing\Route $route, $playerId, $tallyId)
    {
        $playerTally = $this->toolkit->getRepository(\Model\PlayerTally::class)->createModel();
        $playerTally->player_id = $playerId;
        $playerTally->tally_id = $tallyId;
        $playerTally->save();
    }

    public function removeTallyFromPlayer(\Parable\Routing\Route $route, $playerId, $tallyId)
    {
        $playerTallyRepo = $this->toolkit->getRepository(\Model\PlayerTally::class);
        $playerTallyRepo->returnOne();
        $playerTally = $playerTallyRepo->getByConditionSet($playerTallyRepo->createQuery()->buildAndSet([
            ["player_id", "=", $playerId],
            ["tally_id", "=", $tallyId],
        ]));

        $playerTally->delete();
    }
}
