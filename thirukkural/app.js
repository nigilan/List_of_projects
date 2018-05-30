const express = require('express');
const app = express();

require('./controllers/index')(app);

app.use(function(req,res,next){
  res.setHeader('X-Powered-By', 'tkl');
  next();
}); 


app.use(function(req,res){
	res.send({"status" : false, "errMsg" : "URL not Found" , "statusCode" : 404});
});

var server = app.listen(3000, function() {
	var host = server.address().address,
	  	port = server.address().port;
    	console.log(' Server is listening to %s:%s', host, port);
});