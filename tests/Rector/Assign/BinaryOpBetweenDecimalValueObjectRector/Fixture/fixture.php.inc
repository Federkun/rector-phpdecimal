<?php

use Lendable\Entity\LoanApplication;

class PlusOp
{
    public function calculate(LoanApplication $primary, LoanApplication $secondary): void
    {
        $firstAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($primary->getAmount());
        $secondaryAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($secondary->getAmount());

        $total = $firstAmount + $secondaryAmount;
    }
}
-----
<?php

use Lendable\Entity\LoanApplication;

class PlusOp
{
    public function calculate(LoanApplication $primary, LoanApplication $secondary): void
    {
        $firstAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($primary->getAmount());
        $secondaryAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($secondary->getAmount());

        $total = $firstAmount->add($secondaryAmount);
    }
}