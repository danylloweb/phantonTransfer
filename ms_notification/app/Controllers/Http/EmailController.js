'use strict'
const Mail  = use('@sendgrid/mail');
const Env   = use('Env');

class EmailController {
    /**
     * constructor
     */
    constructor() {
        this.send_grid_key = Env.get('SENDGRID_KEY');
    }

    /**
     *
     * @param request
     * @param response
     * @returns {Promise<*>}
     */
    async send({request, response}) {
        try {
            let mail_data = await request.only(['to', 'from','subject','html']);
            Mail.setApiKey(this.send_grid_key);
            Mail.send(mail_data);
            return response.json({message: 'Email enviado com sucesso!'});
        } catch (error) {
            return response.status(error.code).send(error);
        }
    }

}

module.exports = EmailController
