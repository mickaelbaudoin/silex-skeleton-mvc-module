<?php

namespace App\Model\Entities;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="first") 
 * @ORM\Entity(repositoryClass="App\Model\Repositories\FirstRepository")
 */
class First {

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    private $id;

    /** @ORM\Column(type="string") */
    private $name;

    /** @ORM\Column(type="string") */
    private $content;

    /** @ORM\Column(type="datetime") */
    private $created_at;

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getContent() {
        return $this->content;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

}
