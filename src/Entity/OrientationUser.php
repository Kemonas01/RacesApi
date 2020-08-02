<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;
use  App\Controller\GetUserController;
use  App\Controller\GetUserAvatarController;


/**
 * @ORM\Entity(repositoryClass="App\Repository\OrientationUserRepository")
 * @ApiResource(itemOperations={
 *     "user"={
 *             "method"="GET",
 *             "path"="/user",
 *             "controller"=GetUserController::class,
 *             "read"=false,
 *             "normalization_context"={"groups"={"user"}},
 *             "security"="is_granted('ROLE_USER')",
 *             "openapi_context"={
 *                  "summary"="Find user",
 *                  "parameters"={},
 *              },
 *              "responses": {
 *                  "200": {
 *                      "description": "idk2"
 *                  },
 *                  "400": {
 *                      "description": "idk4"
 *                  }
 *              }
 *                  
 *      },
 *   "avatar"={
 *             "method"="GET",
 *             "path"="/user/avatar",
 *             "controller"=GetUserAvatarController::class,
 *             "read"=false,
 *             "format"={"mime"},
 *             "openapi_context"={
 *                  "summary"="Find avatar",
 *                  "parameters"={},
 *              },
 *              "responses": {
 *                  "200": {
 *                      "content": {"image/png"={"schema"={"type"="string","format"="binary"}}},
 *                      "description": "idk2"
 *                  },
 *                  "400": {
 *                      "description": "idk4"
 *                  }
 *              }
 *                  
 *      }
 * 
 * 
 * })
 */
class OrientationUser implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user")
     */
    private $login;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user")
     */
    private $lastname;

    /**
     * @ORM\Column(type="blob")
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrientationRegistered", mappedBy="user", orphanRemoval=true)
     */
    private $registerings;

    public function __construct()
    {
        $this->registerings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|OrientationRegistered[]
     */
    public function getRegisterings(): Collection
    {
        return $this->registerings;
    }

    public function addRegistering(OrientationRegistered $registering): self
    {
        if (!$this->registerings->contains($registering)) {
            $this->registerings[] = $registering;
            $registering->setUser($this);
        }

        return $this;
    }

    public function removeRegistering(OrientationRegistered $registering): self
    {
        if ($this->registerings->contains($registering)) {
            $this->registerings->removeElement($registering);
            // set the owning side to null (unless already changed)
            if ($registering->getUser() === $this) {
                $registering->setUser(null);
            }
        }

        return $this;
    }
}
