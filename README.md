# API application Transfers


## Setup

Use the make command to install

```bash
make install
```
Se houver problemas com AuthSecrets do passport no Linux use commands:

```bash
cd api_transfer/storage/
sudo chown www-data:www-data oauth-public.key
sudo chmod 600 oauth-public.key
```
# Postman Collection
```bash
TestPicPay.postman_collection.json
```

# Observações
Criei esse Microserviço com node para simular a parte de notificação que foi pedida no teste.
No meio dos testes percebi que demorava mais de 13 segundos e o limit do symfony é de 14s Para timeout,
Então decidir desaclopar essa ação em um Ms que envia SMS, Push Notification, e qualquer outro Serviço,
 e as chamadas são Asyncronas tornando assim não bloqueante a ação de transação.
