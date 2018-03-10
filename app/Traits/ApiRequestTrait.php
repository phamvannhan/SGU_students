<?php

namespace App\Traits;

use Dingo\Api\Exception\ResourceException;
use Illuminate\Contracts\Validation\Validator;

trait ApiRequestTrait
{
    /**
     * {@inheritdoc}
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->is(config('api.prefix') . '/*') && (($this->ajax() && ! $this->pjax()) || $this->wantsJson())) {
            throw new ResourceException('Yêu cầu không hợp lệ', $validator->getMessageBag());
        }

        parent::failedValidation($validator);
    }
}