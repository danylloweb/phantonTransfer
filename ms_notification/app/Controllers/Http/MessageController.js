'use strict'
const Env     = use('Env');
const Client  = use('request-promise');

/**
 * class MessageController
 */
class MessageController {
    /**
     * constructor
     */
    constructor() {
        this.sms_key = Env.get('SMS_KEY');
        this.url_production = 'https://api.smsdev.com.br/v1/send';
        this.type   = 9;

    }

    /**
     *
     * @param request
     * @param response
     * @returns {Promise<*>}
     */
    async send({request, response})
    {
      let body     = request.body;
      body.key     = this.sms_key;
      body.type    = this.type;
      let header   = {'Content-Type': 'application/json'};

      Client({method: request.method(), url: this.url_production, headers: header, body: body, json: true});

      return response.json({ message:'Enviado', error : false });
    }
}

module.exports = MessageController
