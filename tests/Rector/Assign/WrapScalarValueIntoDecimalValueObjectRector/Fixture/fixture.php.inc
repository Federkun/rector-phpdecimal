<?php

use Lendable\Entity\LoanApplication;

class Service
{
    public function calculate(LoanApplication $loanApplication): void
    {
        $amount = $loanApplication->getAmount();
    }
}
-----
<?php

use Lendable\Entity\LoanApplication;

class Service
{
    public function calculate(LoanApplication $loanApplication): void
    {
        $amount = \Lendable\ValueObject\MonetaryAmount::fromFloat($loanApplication->getAmount());
    }
}