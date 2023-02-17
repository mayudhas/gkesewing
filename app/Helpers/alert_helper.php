<?php

/**
 * @param $message
 * @param string $status
 * @return void
 */
function setAlert($message, string $status = 'success')
{
    session()->setFlashdata($status, $message);
}
