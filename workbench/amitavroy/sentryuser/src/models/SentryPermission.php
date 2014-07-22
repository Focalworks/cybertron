<?php
/**
 * Created by PhpStorm.
 * User: Amitav Roy
 * Date: 7/22/14
 * Time: 10:39 PM
 */

class SentryPermission extends Eloquent {

    public function matchHiddenAndActualPost($hidden, $postData)
    {
        $arrHiddenKey = explode('|', $hidden);
        $arrHiddenData = explode('|', $postData[$hidden]);
        $strActualKey = $arrHiddenKey[0] . '|' . $arrHiddenKey[1];

        if (!isset($postData[$strActualKey]))
        {
            // unchecked so the data should have allow as 0
            $data = array(
                'permission_id' => $arrHiddenData[0],
                'group_id' => $arrHiddenData[1],
                'allow' => 0,
            );
        }
        else
        {
            // checked so the data should have allow as 1

            $data = array(
                'permission_id' => $arrHiddenData[0],
                'group_id' => $arrHiddenData[1],
                'allow' => 1,
            );
        }

        return $data;
    }
}