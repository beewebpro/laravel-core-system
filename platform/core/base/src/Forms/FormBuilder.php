<?php

namespace Bng\Base\Forms;

use Kris\LaravelFormBuilder\FormBuilder as BaseFormBuilder;

class FormBuilder extends BaseFormBuilder
{
    public function create($formClass, array $options = [], array $data = []): FormAbstract
    {
        $form = parent::create($formClass, $options, $data);

        return apply_filters('base_filter_after_form_created', $form, $form->getModel());
    }
}
