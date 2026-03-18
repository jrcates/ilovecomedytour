<?php
function component($name, $props = []) {
    $render = function() use ($name, $props) {
        extract($props);
        include __DIR__ . "/components/{$name}.php";
    };
    $render();
}
