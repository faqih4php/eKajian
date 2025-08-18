<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{ /**
     * Get the requestKajian associated with the Home
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requestKajian(): HasOne
    {
        return $this->requestKajian(requestKajian::class);
    }
}
