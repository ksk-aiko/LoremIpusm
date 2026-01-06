<?php

namespace Models;

use DateTime;

class User {
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $hashedPassword;
    private string $phoneNumber;
    private string $address;
    private DateTime $birthDate;
    private DateTime $menbershipExpirationDate;
    private string $role;
    private bool $isActive = true;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phoneNumber,
        string $address,
        DateTime $birthDate,
        DateTime $menbershipExpirationDate,
        string $role
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->birthDate = $birthDate;
        $this->menbershipExpirationDate = $menbershipExpirationDate;
        $this->role = $role;
    }

    public function login(string $password) : bool {
        return password_verify($password, $this->hashedPassword);
    }

    public function updateProfile(string $address, string $phoneNumber) : void {
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $expirationDate) : void {
        $this->menbershipExpirationDate = $expirationDate;
    }

    public function changePassword(string $newPassword) : void {
        $this->hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function hasMembershipExpired(): bool {
        $currentDate = new DateTime();
        return $currentDate > $this->menbershipExpirationDate;
    }

    public function toString(): string {
        return sprintf(
            "UserID: %d\nName: %s %s\nEmail: %s\nPhone: %s\nAddress: %s\nBirth Date: %s\nMembership Expiration Date: %s\nRole: %s",
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->menbershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toHTML(): string {
        return sprintf("
            <div class='user-card'>
                <div class='avatar'>SAMPLE</div>
                <h2>%s %s</h2>
                <p>%s</p>
                <p>%s</p>
                <p>%s</p>
                <p>Birth Date: %s</p>
                <p>Membership Expiration Date: %s</p>
                <p>Role: %s</p>
            </div>",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->menbershipExpirationDate->format('Y-m-d'),
            $this->role
    );
    }

    public function toMarkdown(): string {
        return "
            ## User: {$this->firstName} {$this->lastName}
            - **Email:** {$this->email}
            - **PhoneNumber:** {$this->phoneNumber}
            - **Address:** {$this->address}
            - **Birth Date:** {$this->birthDate}
            - **Is Active:** {$this->isActive}
            - **Role:** {$this->role} 
        ";
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'birthDate' => $this->birthDate->format('Y-m-d'),
            'menbershipExpirationDate' => $this->menbershipExpirationDate->format('Y-m-d'),
            'role' => $this->role,
            'isActive' => $this->isActive
        ];
    }
}