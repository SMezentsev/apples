<?php


use common\components\services\ApplesService;
use common\components\services\TreeService;

use common\components\interfaces\ApplesInterface;
use common\components\interfaces\TreeInterface;

return [
	ApplesInterface::class      => ApplesService::class,
    TreeInterface::class      => TreeService::class,
];
