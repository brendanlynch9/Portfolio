//jshint esversion:6
//this first part permits us to start mongoose we name our database here
const mongoose= require('mongoose');
mongoose.connect("mongodb://localhost:27017/fruitsDB", {useNewUrlParser: true});
// once we have mongoose up and started we need to insert a schema apropos
const fruitSchema= new mongoose.Schema({
  //data validation for  string
  name:{
    type: String,
    required: [true, "Please check your data entry no name specified"]
  },
  //data validation with mongoose. We only want a rating between 1 and 10...
  rating: {
    type:Number,
min:1,
max: 10
  },
  review: String
});
//we tell it we will be using the above schema when we call for fruit
const Fruit=mongoose.model("Fruit", fruitSchema);
//we create a fruit
const fruit= new Fruit ({
  name: "Apple",
  rating: 7,
  review: "Its ok for a fruit!"
});

// fruit.save();


//we can do the same for any object as above such like people or a person
const personSchema= new mongoose.Schema({
  name:String,
  age: Number,
  //getting the datbases fruit and person to work together we can add a field:
  favoriteFruit: fruitSchema
});

const Person=mongoose.model("Person", personSchema);

//relationship data
const pineapple= new Fruit({
  name:"Pineapple",
  score:9,
  review:"Great fruit"
});
pineapple.save();
//now we save the new relationship data into the new person:
const person= new Person({
  name:"Amy",
  age: 25,
  favoriteFruit: pineapple
});

//a singular person with no relationship data ie. he doesnt have a favoritefruit
// however if you wanted to update him to have a favorite fruti you could use:
// Person.updateOne({name:"John"}, {favoriteFruit: pineapple}, function(err){
//   if (err){
//     console.log(err);
//   }else{
//     console.log("succesfully updated the document");
//   }
// });

// const person= new Person({
//   name: "John",
//   age:38,
// });
person.save();

//to insert many into a database  this is how
// const kiwi= new Fruit({
//   name:"Kiwi",
//   score: 10,
//   review: "The best fruit"
// });
// const orange= new Fruit({
//   name:"Orange",
//   score: 4,
//   review: "Too sour for me"
// });
// const banana= new Fruit({
//   name:"Banana",
//   score: 3,
//   review: "Weird texture"
// });
// Fruit.insertMany([kiwi, orange, banana], function(err){
//   if (err){
//     console.log (err);
//   }else {
//     console.log("Succesfully saved all the fruits to fruitsDB");
//   }
// });

// now the "read" function of CRUD for mongoose is this
// Fruit.find(function (err, fruits){
//   if (err){
//     console.log(err);
//   }else{
//     // // to log everything in fruits then run this;
//     // console.log(fruits);
// // to run just the names or one particular point then run this;
// fruits.forEach(function(fruit){
//   console.log(fruit.name);
// });
// }
// });

// The update in CRUD is written: in this example we copy the id number and give it an updated name
// Fruit.updateOne({_id:"#"}, {name:"a new name"}, function (err){
//   if (err){
//       console.log (err);
//     }else {
//       console.log("Succesfully updated the document");
//     }
// });

//The delete in CRUD is written :
// Fruit.deleteOne({_id:"#"}, function (err){
//   if (err){
  //       console.log (err);
  //     }else {
  //       console.log("Succesfully deleted the document");
  //     }
  // });


  // //the delete many in CRUD is written:
  // Person.deleteMany({name:"John"}, function (err){
  //   if (err){
  //         console.log (err);
  //       }else {
  //         console.log("Succesfully deleted the document");
  //       }
  //   });
