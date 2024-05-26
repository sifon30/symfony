<?php
// BorrowingSearch.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class BorrowingSearch
{
    private $date;

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
?>