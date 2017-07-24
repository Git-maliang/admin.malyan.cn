<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/20
 * Time: 上午9:59
 */

namespace app\components\widgets;

use Yii;
use yii\base\Widget;

/**
 * 树
 * ```php
 * echo Tree::widget([
 *     'data' => [
 *          [
 *              'name' => '一级1', // 节点名称
 *              'spread' => true, // 是否是展开状态，true为展开状态
 *              'href' => 'http://www.baidu.com', // 是否是展开状态，true为展开状态
 *              'target' => '_self', // 节点链接打开方式
 *              'alias' => 'changyong', //
 *              'data' => [ //为元素添加额外数据，即在元素上添加data-xxx="yyy"，可选
 *                  'nodeName' => '常用文件夹',
 *                  'alias' => 'changyong'
 *               ]
 *              'checkboxValue' => 1, // 复选框的值
 *              'checked' => true, // 复选框默认是否选中
 *              'children' => [ // 子集
 *                  [
 *                      'name' => '二级11', // 节点名称
 *                      'spread' => true, // 是否是展开状态，true为展开状态
 *                      'checkboxValue' => 11, // 复选框的值
 *                      'checked' => true, // 复选框默认是否选中
 *                  ],
 *                  [
 *                      'name' => '二级12',
 *                      'spread' => true,
 *                      'checkboxValue' => 12,
 *                      'checked' => true,
 *                      'children' => [ // 子集
 *                          [
 *                              'name' => '三级121',
 *                              'spread' => true,
 *                              'checkboxValue' => 121,
 *                              'checked' => true,
 *                          ],
 *                          [
 *                              'name' => '三级122',
 *                              'spread' => true,
 *                              'checkboxValue' => 122,
 *                              'checked' => true,
 *                          ],
 *                      ],
 *                  ],
 *              ],
 *          ],
 *          [
 *              'name' => '一级2',
 *              'spread' => true,
 *              'checkboxValue' => 2,
 *              'checked' => true,
 *              'children' => [
 *                  [
 *                      'name' => '二级21',
 *                      'spread' => true,
 *                      'checkboxValue' => 21,
 *                      'checked' => true,
 *                      'children' => [
 *                          [
 *                              'name' => '三级211',
 *                              'spread' => true,
 *                              'checkboxValue' => 211,
 *                              'checked' => true,
 *                          ],
 *                          [
 *                              'name' => '三级212',
 *                              'spread' => true,
 *                              'checkboxValue' => 212,
 *                              'checked' => true,
 *                          ],
 *                          [
 *                              'name' => '三级213',
 *                              'spread' => true,
 *                              'checkboxValue' => 213,
 *                              'checked' => false,
 *                          ],
 *                      ],
 *                  ],
 *                  [
 *                      'name' => '二级22',
 *                      'spread' => true,
 *                      'checkboxValue' => 22,
 *                      'checked' => true,
 *                      'children' => [
 *                          [
 *                              'name' => '三级221',
 *                              'spread' => true,
 *                              'checkboxValue' => 221,
 *                              'checked' => true,
 *                          ],
 *                          [
 *                              'name' => '三级222',
 *                              'spread' => true,
 *                              'checkboxValue' => 222,
 *                              'checked' => true,
 *                          ],
 *                      ],
 *                  ],
 *              ],
 *          ],
 *      ]
 * ]);
 * ```
 */
class Tree extends Widget
{
    /**
     * 指定元素，生成的树放到哪个元素上
     * @var string
     */
    public $id = 'tree';

    /**
     * 设定皮肤
     * @var string
     */
    public $skin = 'as';

    /**
     * 点击每一项时是否生成提示信息
     * @var bool
     */
    public $drag = true;

    /**
     * 勾选风格
     * @var string
     */
    public $check = 'checkbox';

    /**
     * 复选框的name属性值
     * @var string
     */
    public $checkboxName = 'checkbox[]';

    /**
     * 设置复选框的样式，必须为字符串，css样式怎么写就怎么写
     * @var string
     */
    public $checkboxStyle = '';

    /**
     * 数据
     * @var array
     */
    public $data = [];

    public function run(){
        $nodes = json_encode($this->data);
        $js = <<<EOD
            layui.use('tree',
                function() {
                    var tree = layui.tree({
                        elem: "#{$this->id}",
                        skin: "{$this->skin}",
                        drag: {$this->drag},
                        check: "{$this->check}",
                        checkboxName: "{$this->checkboxName}",
                        checkboxStyle: "{$this->checkboxStyle}",
                        nodes: {$nodes}
                    });
                }
            );
EOD;
        $this->getView()->registerCssFile('/js/layui/css/layui.css');
        $this->getView()->registerJsFile('/js/layui/layui.js');
        $this->getView()->registerJs($js);
    }
}
