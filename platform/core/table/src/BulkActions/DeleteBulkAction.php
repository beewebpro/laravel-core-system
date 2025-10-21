<?php

namespace Bng\Table\BulkActions;

use Bng\Base\Events\DeletedContentEvent;
use Bng\Base\Exceptions\DisabledInDemoModeException;
use Bng\Base\Facades\BaseHelper;
use Bng\Base\Http\Responses\BaseHttpResponse;
use Bng\Base\Models\BaseModel;
use Bng\Table\Abstracts\TableBulkActionAbstract;
use Illuminate\Database\Eloquent\Model;

class DeleteBulkAction extends TableBulkActionAbstract
{
    public function __construct()
    {
        $this
            ->label(trans('core/table::table.delete'))
            ->confirmationModalButton(trans('core/table::table.delete'))
            ->beforeDispatch(function () {
                if (BaseHelper::hasDemoModeEnabled()) {
                    throw new DisabledInDemoModeException();
                }
            });
    }

    public function dispatch(BaseModel|Model $model, array $ids): BaseHttpResponse
    {
        $model->newQuery()->whereKey($ids)->each(function (BaseModel $item) {
            $item->delete();

            DeletedContentEvent::dispatch($item::class, request(), $item);
        });

        return BaseHttpResponse::make()
            ->withDeletedSuccessMessage();
    }
}
