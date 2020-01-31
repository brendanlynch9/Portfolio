//jshint esversion:6
require('dotenv').config();
const express=require("express");
const bodyParser=require("body-parser");
const ejs=require("ejs");
const mongoose=require("mongoose");
// to use encryption keys you would use this
// const encrypt=require("mongoose-encryption");
// to use hashing simply use the md5 below
// const md5=require("md5");
// the below was used to use bcrypt however in this module we are going to use passport.js instead and thus need to remove the bcrypt
// const bcrypt=require("bcrypt");
// const saltRounds=10;
//the below is what is needed for passport.js
const session=require('express-session');
const passport=require('passport');
const passportLocalMongoose=require('passport-local-mongoose');
//Oauth 20 for google login
const GoogleStrategy = require('passport-google-oauth20').Strategy;
const findOrCreate=require('mongoose-findOrCreate');

const app=express();



app.use (express.static("public"));
app.set('view engine', 'ejs');
app.use (bodyParser.urlencoded({
  extended:true
}));

// the below is for passport.js this part needs to be right above mongoose.connect
app.use(session({
  secret:"Our little secret.",
  resave:false,
  saveUninitalized:false
}));
app.use(passport.initialize());
app.use(passport.session());
mongoose.connect("mongodb://localhost:27017/userDB", {useNewUrlParser: true});
//the below is for passport.js
mongoose.set("useCreateIndex", true);

const userSchema= new mongoose.Schema({
  email:String,
  password:String,
  googleId:String,
  secret:String
});

// to use encryption keys you would use this.
// userSchema.plugin(encrypt, {secret:process.env.SECRET, encryptedFields:["password"]});

//the below is to use passport.js
userSchema.plugin(passportLocalMongoose);
//the below is for google login
userSchema.plugin(findOrCreate);

const User=new mongoose.model("User", userSchema);

//the below is to use passport.js
passport.use(User.createStrategy());

passport.serializeUser(function(user, done) {
  done(null, user.id);
});

passport.deserializeUser(function(id, done) {
  User.findById(id, function(err, user) {
    done(err, user);
  });
});
//for google login
passport.use(new GoogleStrategy({
    clientID: process.env.CLIENT_ID,
    clientSecret: process.env.CLIENT_SECRET,
    callbackURL: "http://localhost:3000/auth/google/secret",
    userProfileURL: "https://www.googleapis.com/oauth2/v3/userinfo"
  },
  function(accessToken, refreshToken, profile, cb) {
    console.log(profile);
    User.findOrCreate({ googleId: profile.id }, function (err, user) {
      return cb(err, user);
    });
  }
));

app.get("/", function(req,res){
  res.render("home");
});
// for google Login
app.get("/auth/google",
  passport.authenticate("google", {scope:['profile']})
);
//for google login
app.get("/auth/google/secret",
passport.authenticate("google", {failureRedirect: "/login"}),
function(req,res){

  res.redirect("/secrets")
});
app.get("/login", function(req,res){
  res.render("login");
});

app.get("/register", function(req,res){
  res.render("register");
});
//the below is for passport it needs a secrets route
app.get("/secrets", function(req,res){
User.find({"secret":{$ne:null}}, function(err, foundUsers){
  if (err){
    console.log(err);
  }else{
    if (foundUsers){
      res.render("secrets", {usersWithSecrets: foundUsers});
    }
  }
});
});



app.get("/submit", function(req, res){
  if (req.isAuthenticated()){
    res.render("submit");
  }else{
    res.redirect("/login");
  }
});

app.post("/submit", function(req,res){
  const submittedSecret=req.body.secret;
  console.log(req.user.id);

  User.findById(req.user.id, function(err, foundUser){
    if (err){
      console.log(err);
    }else{
      if (foundUser){
        foundUser.secret=submittedSecret;
        foundUser.save(function(){
          res.redirect("/secrets");
        });
      }
    }
  });
});


//the below is to logout and deauthenticate users using passport.js
app.get("/logout", function(req, res){
  req.logout();
  res.redirect("/");
});

app.post ("/register", function (req,res){
// part of bcrypt for app.get /register route and we are moving on to passport.js

//   bcrypt.hash(req.body.password, saltRounds, function(err,hash){
//   const newUser=new User({
//     email:req.body.username,
//     password:hash
//   });
//
//   newUser.save(function(err){
//     if (err){
//       console.log(err);
//     }else{
//       res.render("secrets");
//     }
//   });
// });

//the below is the code for passport.js
User.register({username:req.body.username}, req.body.password, function(err, user){
  if(err){
    console.log(err);
    res.redirect("/register");
  }else{
    passport.authenticate("local")(req,res, function(){
      res.redirect("/secrets");
    });
  }
});
});
app.post("/login", function(req, res){
  // the below was used to permit bcrypt app.post /login and so it is greyed out as we have moved on to passport.js
//   const username= req.body.username;
//   const password= req.body.password;
//
//   User.findOne({email: username}, function(err, foundUser){
//     if (err){
//       console.log(err);
//     }else{
//       if(foundUser){
// bcrypt.compare(password, foundUser.password, function(err, result){
//   if (result === true){
//     res.render("secrets");
//   }
// });
// }
//       }
//   });

//the below is for passport.js
const user=new User({
  username:req.body.username,
  password:req.body.password
});
req.login(user, function(err){
  if(err){
    console.log(err);
  }else{
    passport.authenticate("local")(req, res, function(){
      res.redirect("/secrets");
    });
  }
});
});


app.listen(3000, function(){
  console.log("Server started on port 3000.")
});
