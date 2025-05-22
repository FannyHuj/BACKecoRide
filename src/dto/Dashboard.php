<?php

namespace App\dto;

Class Dashboard {
private ?int $totalUser = null;
private ?int $totalCredit = null;

/**
 * Get the value of totalUser
 */ 
public function getTotalUser()
{
return $this->totalUser;
}

/**
 * Set the value of totalUser
 *
 * @return  self
 */ 
public function setTotalUser($totalUser)
{
$this->totalUser = $totalUser;

return $this;
}

/**
 * Get the value of totalCredit
 */ 
public function getTotalCredit()
{
return $this->totalCredit;
}

/**
 * Set the value of totalCredit
 *
 * @return  self
 */ 
public function setTotalCredit($totalCredit)
{
$this->totalCredit = $totalCredit;

return $this;
}
}