<?php

use Lendable\Entity\LoanApplication;

class WrapAmount
{
    public function calculate(LoanApplication $loanApplication): void
    {
        $amount = $loanApplication->getAmount();
    }
}
-----
<?php

use Lendable\Entity\LoanApplication;

class WrapAmount
{
    public function calculate(LoanApplication $loanApplication): void
    {
        $amount = \Lendable\ValueObject\MonetaryAmount::fromFloat($loanApplication->getAmount());
    }
}