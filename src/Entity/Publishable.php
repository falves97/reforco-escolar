<?php

namespace App\Entity;

interface Publishable
{
    public function isPublished(): bool;

    public function setPublished(bool $published);
}
