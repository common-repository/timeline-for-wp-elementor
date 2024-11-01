<?php
foreach (glob(WPTE_PATH."widgets/*.php") as $includes){
    require_once $includes;
}