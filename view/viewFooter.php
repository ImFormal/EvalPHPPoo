<?php

class ViewFooter {
    //METHOD
    public function displayView(): string {
        ob_start();
        include "view/footer.php";
        return ob_get_clean();
    }
}