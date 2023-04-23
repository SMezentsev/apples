<?php

namespace common\exceptions;

use common\exceptions\Interfaces\ValidationErrorInterface;
use common\helpers\HttpHelper;
use Yii;

class ValidationErrorException extends AbstractException implements ValidationErrorInterface
{
    public static function create(array $errors = [], ?string $message = null): ValidationErrorException
    {
        $ex          = new self();
        $ex->message = Yii::t('app', $message ?? 'Ошибка валидации');
        $ex->setErrors($errors)
            ->setStatusCode(HttpHelper::HTTP_UNPROCESSABLE_ENTITY);

        return $ex;
    }
}
