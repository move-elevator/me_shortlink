<?php

/**
 * TCA eval-function for minimum length of shortlink
 */
class tx_meshortlink_eval
{

    /**
     * min-length of a shortlink
     *
     * @var integer
     */
    protected $minLength = 3;

    /**
     * return JS function to validate shortlink length
     *
     * @return string
     */
    public function returnFieldJS()
    {
        $errorMsg = $GLOBALS['LANG']->sL(
            'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:eval.shortlinkToShort'
        );
        $jsValidator = "
			var theVal = ''+value;
			if(theVal.length < " . $this->minLength . "){
				alert('" . $errorMsg . "');
				return false;
			} else {
				return theVal;
			}
		";

        return $jsValidator;
    }

    /**
     * server-side function to validate shortlink length
     *
     * @param string $value
     * @return string
     */
    public function evaluateFieldValue($value)
    {
        if (strlen($value) < $this->minLength) {
            return '';
        }

        return $value;
    }
}
