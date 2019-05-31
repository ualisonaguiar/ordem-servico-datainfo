<?php

namespace InepZend\Filter;

use Zend\InputFilter\FileInput as ZendFileInput;

class FileInput extends ZendFileInput
{

    protected $autoPrependUploadValidator = false;

}
