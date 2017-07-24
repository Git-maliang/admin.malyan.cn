<?php

return [
    'class' => 'yii\redis\Connection',
    'hostname' => $SYSTEM_CONFIG['SYSTEM_REDIS_HOST'],
    'port' => $SYSTEM_CONFIG['SYSTEM_REDIS_PORT'],
    'database' => $SYSTEM_CONFIG['SYSTEM_REDIS_DATABASE'],
    'password' => $SYSTEM_CONFIG['SYSTEM_REDIS_PASS']
];
