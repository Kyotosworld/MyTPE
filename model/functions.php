<?php
function var_test ($variable, $type) {
        if(isset($variable)) {
                if($variable != '')
                        if(isset($type) && ($type == 'int' || $type == 'string' || $type == 'bool')) {
                                if ($type == 'string')
                                        if($type == (string)$type)
                                                return true;
                                        else return false;
                                elseif ($type == 'int')
                                        if($type == (int)$type)
                                                return true;
                                        else return false;
                                else
                                        if($type == (bool)$type)
                                                return true;
                                        else return false;
                        }
                else return false;
        } else return false;
}
?>
