<?php 

namespace MONGOAPI;

class Helper
{

    /**
     * Verify si $currentKeysList contient les elements de $validesKeys
     *
     * @param array $validesKeys
     * @param array $currentKeysList
     * @return array
     */
    public static function verifyArrayKeys(array $currentKeysList,array $validesKeys):array
    {
       return  array_intersect($currentKeysList,$validesKeys);
    }
    
}

?>