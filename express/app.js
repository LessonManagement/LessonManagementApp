const express = require('express');
const session = require('express-session');
const passport = require('passport');
const bodyparser = require('body-parser');
const https = require('https');
const fs = require('fs');
const path = require('path');
// Google
require('./auth.js');
const data = require('./data.json');

const app = express();
const PUERTO = 443;

// app.use(bodyparser.urlencoded({ extended: false }));
// app.use(bodyparser.json());
app.use(session({ secret: 'cats', resave: false, saveUninitialized: true }));
app.use(passport.initialize());
app.use(passport.session());

//Autentificacion por google
function isLoggedIn(req, res, next) {
    req.user ? next() : res.sendStatus(401);
}

app.get('/auth/google',
    passport.authenticate('google', { scope: ['email', 'profile'] }
    ));

// Ruta home-main


// app.get('/home', isLoggedIn, (req, res) => {
//     res.sendFile(path.resolve('views/home.html'));
// });

app.get('/home', isLoggedIn, (req, res) => {
    let rest = false;
    data.user.emails.forEach((email) => {
        if (req.user.email == email) {
            rest = true;
        }
    });
    resultado = rest == true ? res.sendFile(path.resolve('views/home.html')) : res.sendFile(path.resolve('views/login.html'))
})


app.get('/google/callback',
    passport.authenticate('google', {
        successRedirect: '/home',
        failureRedirect: '/google/failure'
    })
);


app.get('/google/failure', (req, res) => {
    res.send('Fallo en la autentificacion..');
});

// IMPORTAR RUTAS
const routes = require('./routes/routes.js');
app.use(express.static('./views/'));
app.use('/', routes);

// Creamos servidor https
https.createServer({
    cert: fs.readFileSync('certs/express_certificado.crt'),
    key: fs.readFileSync('certs/express_certificado.key')
}, app).listen(PUERTO, () => console.log('Server ON ' + PUERTO));