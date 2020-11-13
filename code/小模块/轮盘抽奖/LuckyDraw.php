<?php
namespace LuckyDraw;

class LuckyDraw
{
    private $prize = [
        [
            'id' => 1,
            'name' => '衣',
            'weight' => '1'
        ], [
            'id' => 2,
            'name' => '食',
            'weight' => '3'
        ], [
            'id' => 3,
            'name' => '住',
            'weight' => '7'
        ], [
            'id' => 4,
            'name' => '行',
            'weight' => '39'
        ]
    ];

    /** 抽奖
     *
     * @param $data
     *  [
     *      id
     *      name 奖品名
     *      weight 权重
     * ]
     *
     * @return mixed
     */
    public function smoke($data="", $share = 100)
    {
        $data = isset($data) & !empty($data) ? $data : $this->prize;
        $win = [];
        foreach ($data as $value) {
            for($i=0;$i<$value['weight'];$i++) {
                $win[] = $value['id'];
            }
        }
        unset($value);
        $len = count($win);
        while ($len<=100) {
            $win[] = 0;
            ++$len;
        }
        shuffle($win);
        $data = $win[array_rand($win)];
        return $data;
    }
}

$data = $_POST;
$l = new LuckyDraw();
echo $l->smoke($data['data'], $data['share'] ?: 100);
