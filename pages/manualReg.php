<?php
if (!file_exists(__DIR__.'/../server/worker.json')) {
    file_put_contents(__DIR__.'/../server/worker.json', json_encode(['username' => 'polas', 'password' => 1234]));
  }

$viskas = json_decode(file_get_contents(__DIR__.'/../server/worker.json'), 1);
