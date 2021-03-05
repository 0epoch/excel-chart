<?php

namespace Lafeng\ExcelChart\Traits;

trait ExcelColumn {

    /**
     * 数字转字母
     */
    protected function numberToLetter(int $num) {
        if($num <= 0) {
            throw new \Exception('数字列必须大于 0！');
        }
        $chr = '';
        $base = 26;
        while($num > 0) {
            $mod = $num % $base;
            if($mod <= 0) {
                $mod = $base;
            }
            $chr = strtoupper(chr($mod + 64)).$chr;
            $num = ($num - $mod) / $base;
        }
        return $chr;
    }

    /**
     * 字母转数字
     */
    protected function letterToNum(string $letter) {
        $latter = strtoupper($letter);
        $len = strlen($latter);
    
        $num = 0;
        for($i=0; $i<$len; $i++) {
            $num = 26 * $num + ord($latter[$i]) - 64;
        }
        return $num;
    }
}