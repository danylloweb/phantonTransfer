<?php

namespace App\Integrations;



/**
 * NotificationTransactionIntegration
 */
class NotificationTransactionIntegration extends AppIntegration
{
    protected $serviceConfig;

    /**
     * __construct
     */
    public function __construct() {
        $this->serviceConfig = "ms_notification";
    }

    /**
     * @return array|\Psr\Http\Message\StreamInterface
     */
    public function handle()
    {
        return $this->processRequest();
    }

}
