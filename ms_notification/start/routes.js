'use strict';
const Route = use('Route');

Route.get('/pic-pay', 'NotificationPicPayController.send');
Route.post('/sendMail', 'EmailController.send');
Route.post('/sendSms', 'MessageController.send');
Route.post('/sendPushNotification', 'NotificationController.send');


