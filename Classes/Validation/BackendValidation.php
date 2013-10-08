<?php

/**
 * TCA Evalfunc for minimun length of shortlink
 */

class tx_meshortlink_eval {
    protected $minLength = 3;
    
    /**
     * return JS function to validate shortlink length
     * @return string
     */
    public function returnFieldJS() {
        $errorMsg = $GLOBALS['LANG']->sL('LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:eval.shortlinkToShort');
        $jsValidator =  "
            var theVal = ''+value;
            if(theVal.length < ".$this->minLength."){
                alert('" . $errorMsg . "');
                return false;
            } else {
                return theVal;
            }
        ";
        
        return $jsValidator;
    }

    /**
     * serverside function to validate shortlink length
     * @return string
     */
    public function evaluateFieldValue($value, $is_in, &$set) {
        if (strlen($value) < $this->minLength) {
            return '';
        }
        
        return $value;
    }

}

?>