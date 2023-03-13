'use strict'
const Env     = use('Env');
const Client  = use('request-promise');


/**
 * class NotificationController
 */
class NotificationController {
    /**
     * constructor
     */
    constructor() {
        this.api_url = Env.get('PUSH_URL');
        this.api_key = Env.get('NOTIFICATION_KEY');
    }

    /**
     *
     * @param request
     * @param response
     * @returns {Promise<*>}
     */
    async send({request, response})
    {

        const data = await request.body;
        let headers = {'Authorization':`key=${this.api_key}`,'Content-Type': 'application/json'};
        let body = {
            to: data.token,
            notification: {
                'body' : data.message,
                'title': "Transferencia realizada com Sucesso",
                'icon' : 'Myicon',
                'sound': 'Mysound'
            }
        }
         Client({method: 'POST', url: this.api_url, headers: headers, body: body, json: true});
         return response.json({ message:'Enviado', error: false });
    }

}

module.exports = NotificationController
