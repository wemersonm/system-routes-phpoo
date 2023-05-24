<?php

use app\support\FlashMessage;

function getFlashMessage(string $field, string $css = '')
{
    if (isset($_SESSION['flash'][$field])) {
        return "<span style='{$css}'>" . FlashMessage::getFlashMessage($field) . "</span>";
    }
}
