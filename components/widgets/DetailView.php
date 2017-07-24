<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/6/24
 * Time: 17:50
 */

namespace app\components\widgets;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use app\components\i18n\Formatter;

class DetailView extends \yii\widgets\DetailView
{
    /**
     * Initializes the detail view.
     * This method will initialize required property values.
     */
    public function init()
    {
        if ($this->model === null) {
            throw new InvalidConfigException('Please specify the "model" property.');
        }
        if ($this->formatter === null) {
            $this->formatter = new Formatter();
        } elseif (is_array($this->formatter)) {
            $this->formatter = Yii::createObject($this->formatter);
        }

        if (!$this->formatter instanceof Formatter) {
            throw new InvalidConfigException('The "formatter" property must be either a Format object or a configuration array.');
        }
        $this->normalizeAttributes();

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }
}