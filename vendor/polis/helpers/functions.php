<?php

function debug(array $data, bool $die = false): void
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if ($die) die;
}