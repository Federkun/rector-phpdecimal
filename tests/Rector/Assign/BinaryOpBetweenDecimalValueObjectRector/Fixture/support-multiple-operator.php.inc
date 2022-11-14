<?php

use Lendable\Entity\LoanApplication;

use Lendable\ValueObject\MonetaryAmount;

class MultipleOp
{
    public function calculate(LoanApplication $primary, LoanApplication $secondary, MonetaryAmount $thirdAmount): void
    {
        $firstAmount = MonetaryAmount::fromFloat($primary->getAmount());
        $secondaryAmount = MonetaryAmount::fromFloat($secondary->getAmount());

        $total = $firstAmount - $secondaryAmount + $thirdAmount - MonetaryAmount::fromFloat(123.0) + $firstAmount;
    }
}
-----
<?php

use Lendable\Entity\LoanApplication;

use Lendable\ValueObject\MonetaryAmount;

class MultipleOp
{
    public function calculate(LoanApplication $primary, LoanApplication $secondary, MonetaryAmount $thirdAmount): void
    {
        $firstAmount = MonetaryAmount::fromFloat($primary->getAmount());
        $secondaryAmount = MonetaryAmount::fromFloat($secondary->getAmount());

        $total = $firstAmount->subtract($secondaryAmount)->add($thirdAmount)->subtract(MonetaryAmount::fromFloat(123.0))->add($firstAmount);
    }
}