<?php

namespace Hydra\Providers;

use \Brush\Accounts\Developer;
use \Brush\Accounts\Account;
use \Brush\Accounts\Credentials;
use \Brush\Pastes\Draft;
use \Brush\Pastes\Options\Visibility;
use \Brush\Pastes\Options\Expiry;
use \Brush\Exceptions\BrushException;
use Hydra\Provider;

class Pastebin implements Provider
{
    private $user;
    private $password;
    private $account;
    private $devKey;
    
    public function __construct ($options = [])
    {
        //var_dump($options);
        $this->user = $options["user"];
        $this->password = $options["password"];
        $this->devKey = $options["key"];
    }

    /**
     * Logins to this provider
     * @throws \Exception if the required data is missing
     */
    public function login () {
        if (empty($this->user) || empty($this->password)) {
            throw new \Exception("Missing login data");
        }
        $this->account = new Account(new Credentials($this->user, $this->password));
    }

    /**
     * Publishes the give paste to this provider
     * @param string $title
     * @param string $text
     * @param string $type
     * @param array $opts
     * @return string
     * @throws \Exception if something fails
     */
    public function publish ($title, $text, $type, $opts = [])
    {
        if (empty($this->account)) {
            $this->login();
        }
        
        $draft = new Draft();
        
        $draft->setTitle($title);
        $draft->setContent($text);
        $draft->setOwner($this->account);

        if ($type == self::TYPE_PRIVATE) {
            $draft->setVisibility(Visibility::VISIBILITY_PRIVATE);
            $draft->setExpiry(Expiry::EXPIRY_NEVER);
        } else {
            $draft->setVisibility(Visibility::VISIBILITY_PUBLIC);
            $draft->setExpiry(Expiry::EXPIRY_ONE_MONTH); // always choose the higher option
        }
        
        $paste = $draft->paste(new Developer($this->devKey));
        
        return $paste->getKey();
    }
}