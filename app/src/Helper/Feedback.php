<?php

namespace App\Helper;

class Feedback {
    const SESSION = 'SessionFeedback';
    
    public static function setMsg($msg, $colorAlert = 'info'): void {
        $_SESSION[Feedback::SESSION]['msg'] = $msg;
        $_SESSION[Feedback::SESSION]['colorAlert'] = $colorAlert;
    }

    public static function getMsg() {
        if (!isset($_SESSION[Feedback::SESSION]) || empty($_SESSION[Feedback::SESSION])) return null;

        $msg = $_SESSION[Feedback::SESSION];
        Feedback::clearMsg();

        return $msg;
    }

    public static function clearMsg(): void {
        unset($_SESSION[Feedback::SESSION]);
    }

    public static function showMsg() {
        $msg = Feedback::getMsg();
        $alert = null;

        if ($msg !== null) $alert = (new Component())->alert($msg['msg'], $msg['colorAlert']);

        return $alert;
    }
}