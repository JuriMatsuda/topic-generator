<?php

class TopicGenerator
{
    static function randomTag($array)
    {
        $topTagName     = '';
        $topPostedCount = '';

        $first = array_slice($array, 0, 1, true);

        foreach ($first as $key => $value) {
            $topTagName = $key;
            $topPostedCount = $value;
        }

        $denominator = array_sum($array);
        $numerator   = mt_rand(0, $denominator);

        $tmp = 0;

        foreach ($array as $tagName => $postedCount) {
            $tmp += $postedCount;
            if ($numerator <= $tmp) {
                echo '投稿数が' . $postedCount . 'ある「' . $tagName . '」について記事を書け。';
                echo PHP_EOL;
                break;
            }
        }
        return 'ちなみに投稿数TOP100のうち一番多いのは「' . $topTagName . '」で' . $topPostedCount . 'だ。';
    }
}

echo 'アドベントカレンダーでネタが無いおまえにヒントを与えてやるからちょっと待ってな。';
echo PHP_EOL;

sleep(3);

$curl = curl_init('https://qiita.com/api/v2/tags?page=1&per_page=100&sort=count');

$option = [
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_RETURNTRANSFER => true,//curlの結果を自動で表示させない
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer daac19d3414d2dc73679510ee889bdfc62ea646b',
        'Content-Type: application/json',
    ],
];

curl_setopt_array($curl, $option);
$result = curl_exec($curl);
curl_close($curl);

$tagInfoList = json_decode($result, true);

$tagList = [];

foreach ($tagInfoList as $tagInfo) {
    $tagList[$tagInfo['id']] = $tagInfo['items_count'];
}

echo TopicGenerator::randomTag($tagList);

