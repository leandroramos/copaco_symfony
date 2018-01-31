<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Respect\Validation\Validator as v;

class IpValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if(!$value || empty($value))
            return true;

        if(!(v::ip()->validate($value))){
          $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
        }
    }
}
