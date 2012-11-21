<?php

class tx_meshortlink_evalfunc {

    public function returnFieldJS() {
	$errorMsg = $GLOBALS['LANG']->sL('LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:eval.shortlinkToShort');
	return "
            var theVal = ''+value;
	    if(theVal.length < 3){
		alert('" . $errorMsg . "');
		return false;
	    } else {
		return theVal;
	    }
        ";
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