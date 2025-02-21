<?php

class ViewHeader {
    //METHOD
    public function displayView(): string {
        ob_start();
        include "view/header.php";
        return ob_get_clean();
    }
}