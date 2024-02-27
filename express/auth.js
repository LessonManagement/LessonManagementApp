const passport = require('passport');
const GoogleStrategy = require('passport-google-oauth2').Strategy;

const GOOGLE_CLIENT_ID = "830487491131-04irptcv4fpgrb5mvek1946vemujt4nn.apps.googleusercontent.com";
const GOOGLE_CLIENT_SECRET = "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";
const data = require('./data.json');

passport.use(new GoogleStrategy({
  clientID: GOOGLE_CLIENT_ID,
  clientSecret: GOOGLE_CLIENT_SECRET,
  callbackURL: "https://localhost:8443/google/callback",
  passReqToCallback: true,
},
  function (request, accessToken, refreshToken, profile, done) {
    return done(null, profile);
  }));

passport.serializeUser(function (user, done) {
  // let res = false;
  // data.user.emails.forEach(item => {
  //   if (item == user.email) {
  //     res = true;
  //   }
  //   if (res) {

  //   } else { done(null, null) }
  // });

  done(null, user);
});

passport.deserializeUser(function (user, done) {
  done(null, user);
});