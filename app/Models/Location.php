<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;

    protected function district(): Attribute
    {
        return Attribute::make(
            get: function () {
                switch($this->borough) {
                    case "Staré Mesto":
                        return "Bratislava I";
                    case "Ružinov":
                        return "Bratislava II";
                    case "Vrakuňa":
                        return "Bratislava II";
                    case "Podunajské Biskupice":
                        return "Bratislava II";
                    case "Nové Mesto":
                        return "Bratislava III";
                    case "Rača":
                        return "Bratislava III";
                    case "Vajnory":
                        return "Bratislava III";
                    case "Karlova Ves":
                        return "Bratislava IV";
                    case "Dúbravka";
                        return "Bratislava IV";
                    case "Lamač":
                        return "Bratislava IV";
                    case "Devín":
                        return "Bratislava IV";
                    case "Devínska Nová Ves":
                        return "Bratislava IV";
                    case "Záhorská Bystrica":
                        return "Bratislava IV";
                    case "Petržalka":
                        return "Bratislava V";
                    case "Jarovce":
                        return "Bratislava V";
                    case "Rusovce":
                        return "Bratislava V";
                    case "Čunovo":
                        return "Bratislava V";
                }
            }
        );
    }
}
