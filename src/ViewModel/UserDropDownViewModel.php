<?php

namespace Iam\ViewModel;

class UserDropDownViewModel
{
    protected string $email;

    protected int $id;

    /**
     * UserDropDownViewModel constructor.
     * @param string $email
     * @param int $id
     */
    public function __construct(string $email, int $id)
    {
        $this->email = $email;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserDropDownViewModel
     */
    public function setEmail(string $email): UserDropDownViewModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserDropDownViewModel
     */
    public function setId(int $id): UserDropDownViewModel
    {
        $this->id = $id;
        return $this;
    }
}
