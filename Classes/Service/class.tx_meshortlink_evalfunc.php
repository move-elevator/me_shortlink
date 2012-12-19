<?php

/**
 * TCA Evalfunc for minimun length of shortlink
 */

class tx_meshortlink_evalfunc {

    /**
     * 
     * @return string
     */
    public function returnFieldJS() {
        $errorMsg = $GLOBALS['LANG']->sL('LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:eval.shortlinkToShort');
        $jsValidator =  "
            var theVal = ''+value;
	    if(theVal.length < 3){
		alert('" . $errorMsg . "');
		return false;
	    } else {
		return theVal;
	    }
        ";
        return $jsValidator;
    }

    public function evaluateFieldValue($value, $is_in, &$set) {
        if (strlen($value) < 3) {
            return '';
        } else {
            return $value;
        }
    }

}

?>