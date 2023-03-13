<?php

namespace App\Integrations;

/**
 * AuthorizerTransactionIntegration
 */
class AuthorizerTransactionIntegration extends AppIntegration
{
    protected $serviceConfig;

    /**
     * __construct
     */
    public function __construct() {
        $this->serviceConfig = "authorizer_transaction";

    }

    /**
     * @return bool
     */
    public function handle():bool
    {
        $response = $this->processRequest();
        return isset($response['message']) && $response['message'] == "Autorizado";
    }

}
