<?php

declare(strict_types=1);

namespace HiToLaKhanh\EasyOP;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;

class Main extends PluginBase{

    public function onEnable() : void {}

    public function onCommand(CommandSender $player, Command $command, string $label, array $args) : bool {
        if($command->getName() === "eop"){
            if($player instanceof Player){
                if($player->hasPermission("eop.command")){
                    if(!isset($args[0])){
                        $player->sendMessage("Usage: /eop <player>");
                    }else{
                        $p = $this->getServer()->getPlayer($args[0]);
                        if($p instanceof Player){
                            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), 'op' . $player);
                            $player->sendMessage(C::YELLOW . "Success!");
                        }else{
                            $player->sendMessage(C::RED . $p . "not online!");
                        }
                    }
                }else{
                    $player->sendMessage(C::RED . "You don't have permission to use this command");
                }
            }else{
                $this->getLogger()->notice("Please use in-game");
            }
        }
        return true;
    }
}
