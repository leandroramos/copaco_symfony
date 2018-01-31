<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use App\Utils\MacTools;
use Respect\Validation\Validator as v;

class MacAddressValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint MacAddress */
        //$mactools = new MacTools();
        $valido = v::macAddress()->validate($value);
        //
        if(!$valido){
          $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
        }
    }
}
