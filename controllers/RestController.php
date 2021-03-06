<?php

namespace filsh\yii2\oauth2server\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;

class RestController extends \yii\rest\Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return ArrayHelper::merge(parent::behaviors(), [
			'exceptionFilter' => [
				'class' => ErrorToExceptionFilter::className()
			],
		]);
	}

	public function actionToken()
	{
		$response = $this->module->getServer()->handleTokenRequest();

		/** @var $response \OAuth2\Response */

		return $response->getParameters();
	}
}