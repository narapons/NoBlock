<?php

namespace NoBlock;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\block\BlockPlaceEvent;

class main extends pluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->Config = new Config($this->getDataFolder() ."Config.yml", Config::YAML, array(
            "指定ワールド数" => 2,
            "world" => "world,worlds"
        ));
    }

    public function block(BlockPlaceEvent $event)
    {
        $player = $event->getPlayer();
        $world = $player->getLevel()->getName();

        $config1 = $this->Config->get("指定ワールド数");
        $config2 = $this->Config->get("world");

        if(!$player->isOp()) {

            if ($config1 == 1) {
                if ($world == $config2) {
                    $event->setCancelled();
                    $player->sendPopup("§l§cブロックを設置する権限がありません");
                }
            } else {
                $config2 = explode(",", $config2);
                for ($i = 0; $i < $config1; $i++) {
                    if ($world == $config2[$i]) {
                        $event->setCancelled();
                        $player->sendPopup("§l§cブロックを設置する権限がありません");
                    }
                }
            }

        }

    }
}