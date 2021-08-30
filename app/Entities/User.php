<?php


namespace App\Entities;


use Ramsey\Uuid\UuidInterface;

class User extends BaseEntity
{

    public function __construct(private string $name,
                                private string $phone,
                                private string $email,
                                UuidInterface $id)
    {
        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

}
