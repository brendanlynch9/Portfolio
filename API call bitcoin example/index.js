//jshint esversion:6
const express= require('express');
const bodyParser=require('body-parser');
const app=express();
const request=require("request");
app.use(bodyParser.urlencoded({extended: true}));

app.get("/", function(req, res){
  res.sendFile(__dirname + "/index.html");
});

app.post("/", function(req, res){
  // console.log(req.body.crypto);
  var crypto= req.body.crypto;
  var fiat= req.body.fiat;
  var amount=req.body.amount;

var options={
  url:"https://apiv2.bitcoinaverage.com/convert/global",
method:"GET",
qs:{
  from:crypto,
  to: fiat,
  amount: amount
}
};
  request(options, function (error, response, body){
var data=JSON.parse(body);
var price=data.price;
var currentDate= data.time;
res.write("<p>The current date is "+currentDate + "</p>");
res.write("<h1>"+amount + crypto + " is currently worth " + price + fiat+ "</h1");
  res.send();
  });
});

app.listen (3000, function(){
  console.log("Server is running on port 3000 master..may I make you some coffee now? :)");
});
