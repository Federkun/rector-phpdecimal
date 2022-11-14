<?php

use Lendable\Entity\LoanApplication;

use Lendable\ValueObject\MonetaryAmount;

class MultiplePlusOp
{
    public function calculate(LoanApplication $primary, LoanApplication $secondary, MonetaryAmount $thirdAmount): void
    {
        $firstAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($primary->getAmount());
        $secondaryAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($secondary->getAmount());

        $total = $firstAmount + $secondaryAmount + $thirdAmount + MonetaryAmount::fromFloat(123.0);
    }
}
-----
<?php

use Lendable\Entity\LoanApplication;

use Lendable\ValueObject\MonetaryAmount;

class MultiplePlusOp
{
    public function calculate(LoanApplication $primary, LoanApplication $secondary, MonetaryAmount $thirdAmount): void
    {
        $firstAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($primary->getAmount());
        $secondaryAmount = \Lendable\ValueObject\MonetaryAmount::fromFloat($secondary->getAmount());

        $total = $firstAmount->add($secondaryAmount)->add($thirdAmount)->add(MonetaryAmount::fromFloat(123.0));
    }
}