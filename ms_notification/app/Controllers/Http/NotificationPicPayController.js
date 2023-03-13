'use strict'
const Env     = use('Env');
const Client  = use('request-promise');


/**
 * class NotificationPicPayController
 */
class NotificationPicPayController {
    /**
     * constructor
     */
    constructor() {
        this.api_url = Env.get('NOTIFICATION_PIC_PAY_URL');
    }

    /**
     * @param response
     * @returns {Promise<*>}
     */
    async send({response})
    {
         console.log("send Notification->"+ this.api_url);
         Client({method: 'GET', url: this.api_url, headers: {'Accept': '*/*'}});
         return response.json({ message:'Enviado', error: false });
    }

}

module.exports = NotificationPicPayController
