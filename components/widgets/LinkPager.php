<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/7
 * Time: 下午1:21
 */

namespace app\components\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
 * Class GoLinkPager
 * @package app\components\widgets
 */
class LinkPager extends \yii\widgets\LinkPager
{
    public $firstPageLabel = '首页';
    public $lastPageLabel = '未页';
    public $prevPageLabel = '上一页';
    public $nextPageLabel = '下一页';
    public $pageCssClass = 'hidden-sm hidden-xs';

    public $template = '{pageButtons}{customPage}';
    /**
     * pageSize list
     */
    public $pageSizeList = [10, 20, 30, 50];

    /**
     * @var string the CSS class for the "first" page button.
     */
    public $firstPageCssClass = 'first';
    /**
     * @var string the CSS class for the "last" page button.
     */
    public $lastPageCssClass = 'last';
    /**
     * @var string the CSS class for the "previous" page button.
     */
    public $prevPageCssClass = 'prev';
    /**
     * @var string the CSS class for the "next" page button.
     */
    public $nextPageCssClass = 'next';
    /**
     * @var string the CSS class for the active (currently selected) page button.
     */
    public $activePageCssClass = 'active';

    public $disabledPageCssClass = 'disabled';

    public $maxButtonCount = 8;

    public $pageSizeBefore = '显示';

    public $pageSizeAfter = '条';

    public $pageSizeOptions = [
        'class' => 'form-control',
        'style' => [
            'display' => 'inline-block',
            'width' => 'auto',
            'height' => '32px',
        ],
    ];

    public $customPageBefore = '跳转至 ';

    public $customPageAfter = ' 页';

    public $customPageOptions = [
        'class' => 'form-control center',
        'style' => [
            'display' => 'inline-block',
            'height' => '32px',
            'width' => '42px',
        ],
    ];

    public function init()
    {
        parent::init();
    }

    /**
     * Executes the widget.
     * This overrides the parent implementation by displaying the generated page buttons.
     */
    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
        echo Html::tag('ul', $this->renderPageContent(), $this->options);
    }

    protected function renderPageContent()
    {
        return preg_replace_callback('/\\{([\w\-\/]+)\\}/', function ($matches) {
            $name = $matches[1];
            if ('customPage' == $name) {
                return $this->renderCustomPage();
            } else if ('pageSize' == $name) {
                return $this->renderPageSize();
            } else if ('pageButtons' == $name) {
                return $this->renderPageButtons();
            }
            return '';
        }, $this->template);
    }

    /**
     * 显示页数
     * @return string
     */
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton($firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
        }

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
        }

        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, $this->disableCurrentPageButton && $i == $currentPage, $i == $currentPage);
        }

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton($lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        return implode("\n", $buttons);
    }

    /**
     * 显示条数
     * @return string
     */
    protected function renderPageSize()
    {
        $pageSizeList = [];
        foreach ($this->pageSizeList as $value) {
            $pageSizeList[$value] = $value;
        }
        return Html::tag('li', $this->pageSizeBefore . Html::dropDownList($this->pagination->pageSizeParam, $this->pagination->getPageSize(), $pageSizeList, $this->pageSizeOptions) . $this->pageSizeAfter, ['style' => 'padding-left:8px', 'class' => 'hidden-sm hidden-xs']);
    }

    /**
     * 跳转
     * @return string
     */
    protected function renderCustomPage()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }
        $page = 1;
        $params = Yii::$app->getRequest()->queryParams;
        if (isset($params[$this->pagination->pageParam])) {
            $page = intval($params[$this->pagination->pageParam]);
            if ($page < 1) {
                $page = 1;
            } else if ($page > $pageCount) {
                $page = $pageCount;
            }
        }
        return Html::tag('li', $this->customPageBefore . Html::textInput($this->pagination->pageParam, $page, $this->customPageOptions) . $this->customPageAfter, ['style' => 'padding-left:8px', 'class' => 'hidden-sm hidden-xs']);
    }
}
