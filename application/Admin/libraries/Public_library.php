<?php
/**
 * 公共方法类
 * @Author: lidandan
 * @Date:   2017-12-22 16:16:57
 */
class Public_library
{
    /**
     * 加密算法
     * @param  string $auth 加密数据
     * @return string
     */
    public function password($auth)
    {
        return md5('CI'.$auth.'DAN');
    }
}
