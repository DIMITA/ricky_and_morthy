<?php

declare(strict_types=1);

namespace App\Entity\Enums;

enum RoleType: string
{
    case REALISATEUR = "Realisateur";
    case ACTEUR = "Acteur";
}
