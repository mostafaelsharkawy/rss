<?php

class Application_Form_Add extends Zend_Form {

    public function init() {
        /* Form Elements & Other Definitions Here ... */
        $link = new Zend_Form_Element_Text('link');
        $link->setRequired();
        $link->setLabel('link')->setAttrib('class', 'form-label');
        $link->setAttrib('class', 'form-control');
        $link->addFilter('stringTrim');
        $link->addValidator(new Zend_Validate_Db_NoRecordExists(
                array(
            'table' => 'links',
            'field' => 'link',
                )
        ));
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('class', 'btn btn-primary');
		$this->setAttrib('class', 'form-horizontal');
        $this->addElements(array( $link, $submit));
    }

}
