<?php

namespace Config;

class App implements
    \Parable\Framework\Interfaces\Config
{
    /**
     * @return array
     */
    public function get()
    {
        return [
            "parable" => [
                "app" => [
                    "title" => "Tally",
                    "version" => "3.0.0",
                ],
                "session" => [
                    "autoEnable" => true,
                ],
                "database" => [
                    "type" => \Parable\ORM\Database::TYPE_SQLITE,
                    "location" => BASEDIR . "/storage/tally.sqlite",
                ],
                "inits" => [
                    \Init\Layout::class,
                ],
                "routes" => [
                    \Routing\App::class,
                ],
            ],
        ];
    }
}
