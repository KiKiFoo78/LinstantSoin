<?php
namespace InstantSoin\UserBundle\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use InstantSoin\UserBundle\Component\Validator\Constraints;

class ZipCodeValidator extends ConstraintValidator
{
    private function isValidZipCode($value){
        return 0 === preg_match('/\d{5}/', $value);
    }

    public function validate($value, Constraint $constraint)
    {
        if( $this->isValidZipCode($value) === true ) {
            $this->context->addViolation($constraint->message, array('{{ value }}' => $value));

            return false;
        }

        return true;
    }
}