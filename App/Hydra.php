<?php

namespace Hydra;

class Hydra
{
    private $config;
    
    public function __construct ($config = []) {
        if (sizeof($config) > 0) {
            $this->setConfig($config);
        }
    }

    /**
     * Set Hydra config
     * @param array $config
     */
    public function setConfig ($config) {
        $this->config = $config;
    }

    /**
     * Get Hydra config
     * @return mixed
     */
    public function getConfig () {
        return $this->config;
    }

    /**
     * Publish a paste to all available providers
     * @param string $title
     * @param string $text
     * @param string $type
     * @param array $opts
     * @return array
     */
    public function publish ($title, $text, $type, $opts = [])
    {
        $result = [];
        
        foreach ($this->config["accounts"] as $providerName => $conf)
        {
            $class = "\\Hydra\\Providers\\" . $providerName;
            
            try {
                $provider = new $class($conf);
                $result[$providerName] = $provider->publish($title, $text, $type, $opts);
            } catch (\Exception $e) {
                $result[$providerName] = false;
            }
        }
        
        return $result;
    }
}