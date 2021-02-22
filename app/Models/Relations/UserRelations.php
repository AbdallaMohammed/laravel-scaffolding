<?php

namespace App\Models\Relations;

use App\Models\Book;

trait UserRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
