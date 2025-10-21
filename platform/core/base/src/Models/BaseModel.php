<?php

namespace Bng\Base\Models;

use Bng\Base\Contracts\BaseModel as BaseModelContract;
use Bng\Base\Facades\MacroableModels;
use Bng\Base\Models\Concerns\HasBaseEloquentBuilder;
use Bng\Base\Models\Concerns\HasMetadata;
use Bng\Base\Models\Concerns\HasUuidsOrIntegerIds;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model implements BaseModelContract
{
    use HasBaseEloquentBuilder;
    use HasMetadata;
    use HasUuidsOrIntegerIds;

    public function __get($key)
    {
        if (MacroableModels::modelHasMacro(static::class, $method = 'get' . Str::studly($key) . 'Attribute')) {
            return $this->{$method}();
        }

        return parent::__get($key);
    }
}
