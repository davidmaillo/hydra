<?php

namespace Hydra;

interface Provider
{
    const TYPE_PUBLIC = "public";
    const TYPE_PRIVATE = "private";
    
    public function login ();
    public function publish ($title, $text, $type, $opts = []);
}