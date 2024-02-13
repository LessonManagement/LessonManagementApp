const router = require('express').Router();
const path = require('path');

// Ruta raíz
router.get('/', function (req, res) {
    // Comprobaciones de token y si no hay redirige a login
    if (req.query.hasOwnProperty('login')) {
        console.log(req.query.login);
        if (req.query.login == 'true') {
            res.setHeader('Content-Type', 'text/html');
            res.redirect('/home');
        } else {
            res.setHeader('Content-Type', 'text/html');
            res.redirect('/login');
        }
    } else {
        res.setHeader('Content-Type', 'text/html');
        res.redirect('/login');
    }
})

// Ruta login
router.get('/login', (req, res) => {
    res.sendFile(path.resolve('views/login.html'))
})

// Ruta home/main
router.get('/home', (req, res) => {
    res.sendFile(path.resolve('views/home.html'))
})

module.exports = router;