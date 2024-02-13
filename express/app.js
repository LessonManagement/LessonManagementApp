const express = require('express');
const bodyparser = require('body-parser');
const https = require('https');
const fs = require('fs');

const app = express();
const PUERTO = 443;

app.use(bodyparser.urlencoded({ extended: false }));
app.use(bodyparser.json());

// IMPORTAR RUTAS
const routes = require('./routes/routes.js');
app.use(express.static('./views/'));
app.use('/', routes);

// Creamos servidor https
https.createServer({
    cert: fs.readFileSync('certs/express_certificado.crt'),
    key: fs.readFileSync('certs/express_certificado.key')
}, app).listen(PUERTO, () => console.log('Server ON ' + PUERTO));