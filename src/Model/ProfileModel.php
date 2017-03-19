<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace Model;


use FastD\Model\Model;

class ProfileModel extends Model
{
    public function findProfile($id)
    {
        return [
            'id' => $id
        ];
    }
}