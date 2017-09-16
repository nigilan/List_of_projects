const express = require('express');
const app = express();
const axios = require('axios');
const exphbs = require('express-handlebars');
const config = require('./config/config.js');

app.engine('handlebars', exphbs({defaultLayout: 'main'}));
app.set('view engine', 'handlebars');

app.get('/', function(req, res) {
  
  axios.get('https://api.nasa.gov/planetary/apod?api_key='+config.apiKey)
    .then(response => {
      res.render('home', {description : response.data.explanation, imgsrc: response.data.url});
      return;
   })
    .catch(error => {
      res.render('home', {description : "Sorry!! No Image found !!!", imgsrc: "http://www.404notfound.fr/assets/images/pages/img/androiddev101.jpg"});
      return;
  });
});
 
var server = app.listen(3000, function() {
	var host = server.address().address,
	  	port = server.address().port;
    	console.log(' Server is listening to %s:%s', host, port);
});