var modelData = require('../models');
module.exports = function(app) {
    app.get("/api/getkural/:id", function(req,res){
        modelData.getRecord(req.params.id, function (err,data){
            if(err){
                res.send({status:500,data:"",errMsg:err});
            }
            res.send({status:200,data:data,errMsg:""});
        });        
    });    
}